<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Classes;
// use App\Models\Notification;
use App\Models\Qualification;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Notifications\NewUserInfo;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\SpecialCourse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
// use App\Http\Controllers\Admin\Notification;
use App\Http\Controllers\Admin\Notification;
use Illuminate\Support\Facades\Notification as systemNotification;
use App\Models\Certificate, App\Models\Fee;
use App\Models\CheckClassOrCourceRegistration;
use App\Models\Country;
use App\Models\Course;
use App\Models\OtherPaymentDetails;
use App\Models\Video;
use App\Notifications\RegistrationSuccessMail;
use App\Notifications\WelcomeMailForPaidUsers;
use Exception;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Notification as FacadesNotification;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $classes = Classes::latest()->get();
        $special_courses = SpecialCourse::where('class_id',null)->latest()->get();
        $phonecodes = Country::Where('phonecode', '!=', '')
        ->select('phonecode')
        ->get();
        return view('auth.register', compact('classes','special_courses','phonecodes'));
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'dob' => ['required', 'date'],
            'gender' => ['required'],
            // 'class' => ['required'],
            'image' => ['required', 'mimes:png,jpg,jpeg'],
            'mobile' => ['required'],
            'certificate' => ['required', 'mimes:pdf']
        ]);
    }

    public function register(Request $request)
    {
        // dd($request->all());
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        return redirect()->route('login')->with('success', 'Your registration is successful, waiting for admin approval');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        DB::beginTransaction();
        try {
            $student_count = User::where('role_id', 4)->count();
            $num_padded = sprintf("%05d", ($student_count + 1));
            $id_no = 'LLST' . $num_padded;
            $image = $data['image'];
            $imageName = imageUpload($image, 'profile_image');
            $admin_details = User::select('email')->where('role_id', 1)->first();
            $admin_email = $admin_details['email'];
            $email_data = array(
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'id_no' => $id_no,
                'user_type' => 'student'
            );
            if (isset($data['special_course_ids'])) {
                $special_course_ids = implode(',', $data['special_course_ids']);
                $admission_type = 2;
            } else {
                $special_course_ids = null;
                $admission_type = 1;
            }

            $user = new User();
            $user->first_name = $data['first_name'];
            $user->last_name = $data['last_name'];
            $user->email = $data['email'];
            $user->mobile = $data['mobile'];
            $user->id_no =  $id_no;
            $user->dob = $data['dob'];
            $user->class = $data['class'];
            $user->gender = $data['gender'];
            $user->password = Hash::make('Welcome'.date('Y'));
            $user->image = $imageName;
            $user->special_course_ids = $special_course_ids;
            $user->country_code = $data['country_code'];
            $user->registration_type = $admission_type;
            $user->save();

            $user_id = $user->id;
            createNotification($user_id, 0, 0, 'student_registration');

            // Fee generate
            $feedata = [];
            if($user->class > 0){
                if (!empty($data['special_course_ids']) && count($data['special_course_ids']) > 0){
                    foreach ($data['special_course_ids'] as $key => $course) {
                        $s_course = SpecialCourse::where('id', $course)->first();
                        $course_start_date = $s_course->start_date;
                        if ($s_course) {
                            $next_date = date('Y-m-01',strtotime($course_start_date));
                            $next_due_date = date('Y-m-d', strtotime($next_date. ' + 4 days'));
                            $feedata[] = [
                                'user_id' => $user->id,
                                'class_id' => 0,
                                'course_id' => $s_course->id,
                                'fee_type' => 'course_fee',
                                'due_date' => $next_due_date,
                                'payment_month' => date("F",strtotime($course_start_date)),
                                'amount' => $s_course->monthly_fees,
                            ];
                        }
                    }
                }
                if (empty($data['special_course_ids'])){
                    $check_class = Classes::where('id', $user->class)->first();
                    if ($check_class) {
                        $next_date = date('Y-m-d',strtotime('first day of +2 month'));
                        $next_due_date = date('Y-m-d', strtotime($next_date. ' + 4 days'));
                        $feedata[] = [
                            'user_id' => $user->id,
                            'class_id' => $check_class->id,
                            'course_id' => 0,
                            'fee_type' => 'admission_fee',
                            'due_date' => $next_due_date,
                            'payment_month' => date('F',strtotime($next_due_date)),
                            'amount' => $check_class->monthly_fees + $check_class->admission_fees,
                        ];
                    }
                }
            }
            if ($user->class == 0) {
                if (!empty($data['special_course_ids']) && count($data['special_course_ids']) > 0) {
                    foreach ($data['special_course_ids'] as $key => $course) {
                        $s_course = SpecialCourse::where('id', $course)->first();
                        $course_start_date = $s_course->start_date;
                        if ($s_course) {
                            $next_date = date('Y-m-01',strtotime($course_start_date));
                            $next_due_date = date('Y-m-d', strtotime($next_date. ' + 4 days'));
                            $feedata[] = [
                                'user_id' => $user->id,
                                'class_id' => 0,
                                'course_id' => $s_course->id,
                                'fee_type' => 'course_fee',
                                'due_date' => $next_due_date,
                                'payment_month' => date("F",strtotime($course_start_date)),
                                'amount' => $s_course->monthly_fees,
                            ];
                        }
                    }
                }

            }

            if (count($feedata) > 0) {
                DB::table('fees')->insert($feedata);
            }
            //Store certificate
            $certificate_image =  imageUpload($data['certificate'], 'student_certificate');
            $certificate = new Certificate();
            $certificate->user_id = $user->id;
            $certificate->image = $certificate_image;
            $certificate->save();

            // $admin_details = User::select('email')->where('role_id', 1)->first();
            // $admin_email = $admin_details['email'];
            $admin_email = "abcd12300@yopmail.com";
            $email_data = array(
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'id_no' => $id_no,
                'user_type' => 'student'
            );
            // FacadesNotification::route('mail', $admin_email)->notify(new NewUserInfo($email_data));
            /**
             * Notification sent to inform the registered users
             */
            systemNotification::route('mail', $user->email)->notify(new RegistrationSuccessMail($user));
            DB::commit();
            return $user;
        } catch (Exception $e) {
            DB::rollback();
            return 0;
        }
    }

    public function getCode()
    {
        $code = generateUniqueCode();
        $checkExisting = User::where('id_no', $code)->count();
        if ($checkExisting == 0) {
            return $code;
        }
        return $this->getCode();
    }

    public function teacher_register(Request $request)
    {
        if ($request->method() == 'GET') {
            $phonecodes = Country::Where('phonecode', '!=', '') ->select('phonecode')->get();
            $qualifications = Qualification::orderBy('name')->get();
            return view('auth.teacher_register', compact('qualifications','phonecodes'));
        } else if ($request->method() == 'POST') {
            $this->validate($request, [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'doj' => ['required', 'date'],
                'gender' => ['required'],
                'image' => ['required','mimes:png,jpg'],
                'mobile' => ['required'],
                'qualification' => ['required']
            ]);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = imageUpload($image, 'profile_image');
            } else {
                $imageName = null;
            }

            $teachers_count = User::where('role_id', 3)->count();
            $num_padded = sprintf("%05d", ($teachers_count + 1));
            $id_no = 'LLTR' . $num_padded;
            // $unique_id = $this->getCode();
            // $id_no = 'LLTR'.$unique_id;

            if ($request->qualification === 'Others') {

                Validator::make($request->all(), [
                    'other_qualification' => 'required|string|max:255|unique:qualifications,name',
                ], $messages = [
                    'other_qualification.unique' => 'This qualification name field is already available.',
                ])->validate();
                $qualification = new Qualification();
                $qualification->name = $request->other_qualification;
                $qualification->save();

                $qualification_id = $qualification->id;
            } else {
                $qualification_id = $request->qualification;
            }


            $user = new User();
            $user->role_id = 3;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->doj = $request->doj;
            $user->gender = $request->gender;
            $user->id_no = $id_no;
            $user->password = Hash::make('Welcome'.date('Y'));
            $user->image = $imageName;
            $user->mobile = $request->mobile;
            $user->country_code = $request->country_code;
            $user->qualification_id = $qualification_id;
            $user->save();

            $user_id = $user->id;
            createNotification($user_id, 0, 0, 'teacher_registration');
            // dd($noti);


            //Store certificate
            $file_name =  imageUpload($request->certificate, 'teacher_certificate');
            $certificate = new Certificate();
            $certificate->image = $file_name;
            $certificate->user_id = $user->id;
            $certificate->save();

            // $admin_details = User::select('email')->where('role_id', 1)->first();
            // $admin_email = $admin_details['email'];
            $admin_email = "abcd12300@yopmail.com";
            $email_data = array(
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'id_no' => $id_no,
                'user_type' => 'teacher'
            );
            FacadesNotification::route('mail', $admin_email)->notify(new NewUserInfo($email_data));

            /**
             * Notification sent to inform the registered users
             */
            systemNotification::route('mail', $user->email)->notify(new RegistrationSuccessMail($user));

            return redirect()->route('teacher_login')->with('success', 'Your registration is successful, waiting for admin approval');
        }
    }

    // HR registration
    public function hr_register(Request $request)
    {
        if ($request->method() == 'GET') {
            $qualifications = Qualification::orderBy('name')->get();
            return view('auth.hr_register', compact('qualifications'));
        } else if ($request->method() == 'POST') {
            $this->validate($request, [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'doj' => ['required', 'date'],
                'gender' => ['required'],
                'image' => ['required','mimes:png,jpg'],
                'mobile' => ['required'],
                'qualification' => ['required']
            ]);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = imageUpload($image, 'profile_image');
            } else {
                $imageName = null;
            }

            // $unique_id = $this->getCode();
            // $id_no = 'LLHR'.$unique_id;
            $hr_count = User::where('role_id', 2)->count();
            $num_padded = sprintf("%05d", ($hr_count + 1));
            $id_no = 'LLHR' . $num_padded;

            if ($request->qualification === 'Others') {

                Validator::make($request->all(), [
                    'other_qualification' => 'required|string|max:255|unique:qualifications,name',
                ], $messages = [
                    'other_qualification.unique' => 'This qualification name field is already available.',
                ])->validate();
                $qualification = new Qualification();
                $qualification->name = $request->other_qualification;
                $qualification->save();

                $qualification_id = $qualification->id;
            } else {
                $qualification_id = $request->qualification;
            }

            $user = new User();
            $user->role_id = 2;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->doj = $request->doj;
            $user->gender = $request->gender;
            $user->id_no = $id_no;
            $user->password = Hash::make('Welcome'.date('Y'));
            $user->image = $imageName;
            $user->mobile = $request->mobile;
            $admin_details = User::select('email')->where('role_id', 1)->first();
            $user->country_code = $request->country_code;
            $user->qualification_id = $qualification_id;
            $user->save();

            $user_id = $user->id;
            createNotification($user_id, 0, 0, 'user_registration');

            //Store certificate
            $file_name =  imageUpload($request->certificate, 'hr_certificate');
            $certificate = new Certificate();
            $certificate->image = $file_name;
            $certificate->user_id = $user->id;
            $certificate->save();


            // $admin_details = User::select('email')->where('role_id', 1)->first();
            // $admin_email = $admin_details['email'];
            $admin_email = "abcd12300@yopmail.com";
            $email_data = array(
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'id_no' => $id_no,
                'user_type' => 'hr'
            );
            FacadesNotification::route('mail', $admin_email)->notify(new NewUserInfo($email_data));

            /**
             * Notification sent to inform the registered users
             */
            systemNotification::route('mail', $user->email)->notify(new RegistrationSuccessMail($user));

            return redirect()->route('hr_login')->with('success', 'Your registration is successful, waiting for admin approval');
        }
    }

    // Flash Course Wise registration
    public function student_flash_course_register(Request $request,$id)
    {
        if ($request->method() == 'GET') {
            $data = array();
            $data['course_id'] = $id;
            $data['flash_courses'] = Course::latest()->get();
            return view('auth.flash_course_register')->with($data);
        } else if ($request->method() == 'POST') {
            // dd($request->all());
            $this->validate($request, [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'dob' => ['required', 'date'],
                'gender' => ['required'],
                'image' => ['required', 'mimes:png,jpg,jpeg'],
                'mobile' => ['required'],
                'certificate' => ['required', 'mimes:pdf']
            ]);
            DB::beginTransaction();
        try {
            $student_count = User::where('role_id', 4)->count();
            $num_padded = sprintf("%05d", ($student_count + 1));
            $id_no = 'LLST' . $num_padded;

            $image = $request['image'];
            $imageName = imageUpload($image, 'profile_image');

            // Store student details
            $user = new User();
            $user->first_name = $request['first_name'];
            $user->last_name = $request['last_name'];
            $user->email = $request['email'];
            $user->mobile = $request['mobile'];
            $user->id_no =  $id_no;
            $user->dob = $request['dob'];
            $user->gender = $request['gender'];
            $user->password = Hash::make('Welcome'.date('Y'));
            $user->image = $imageName;
            $user->flash_course_id = $request['class'];
            $user->registration_type = 3;
            $user->country_code = $request['country_code'];
            $user->save();

            $user_id = $user->id;
            createNotification($user_id, 0, 0, 'student_registration');

            // Fee generate
            $feedata = [];
            if($user->flash_course_id > 0){
                $s_course = Course::where('id', $request['class'])->first();
                $course_start_date = $s_course->start_date;
                if ($s_course) {
                    // $next_date = date('Y-m-01',strtotime($course_start_date));
                    // $next_due_date = date('Y-m-d', strtotime($next_date. ' + 4 days'));
                    $feedata[] = [
                        'user_id' => $user->id,
                        'class_id' => 0,
                        'course_id' => 0,
                        'flash_course_id' => $s_course->id,
                        'fee_type' => 'flash_course_fee',
                        // 'due_date' => $next_due_date,
                        'payment_month' => date("F"),
                        'amount' => $s_course->fees,
                    ];
                }
            }

            if (count($feedata) > 0) {
                DB::table('fees')->insert($feedata);
            }

            //Store certificate
            $certificate_image =  imageUpload($request['certificate'], 'student_certificate');
            $certificate = new Certificate();
            $certificate->user_id = $user->id;
            $certificate->image = $certificate_image;
            $certificate->save();

            // $admin_details = User::select('email')->where('role_id', 1)->first();
            // $admin_email = $admin_details['email'];
            $admin_email = "abcd12300@yopmail.com";
            $email_data = array(
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'email' => $request['email'],
                'id_no' => $id_no,
                'user_type' => 'student'
            );
            // FacadesNotification::route('mail', $admin_email)->notify(new NewUserInfo($email_data));

            /**
             * Notification sent to inform the registered users
             */
            systemNotification::route('mail', $user->email)->notify(new RegistrationSuccessMail($user));
            DB::commit();
            return redirect()->route('login')->with('success', 'Your registration is successful, waiting for admin approval');
        } catch (Exception $e) {
            DB::rollback();
            return 0;
        }
        }
    }

    // Paid video subscription
    public function video_subscription(Request $request,$id)
    {
        if ($request->method() == 'GET') {
            $data = array();
            $data['video_id'] = $id;
            $data['videos'] = Video::where('video_type',1)->latest()->get();
            return view('auth.video_subscription')->with($data);
        } else if ($request->method() == 'POST') {
            // dd($request->all());
            $this->validate($request, [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'dob' => ['required', 'date'],
                'gender' => ['required'],
                // 'image' => 'required| mimes:png,jpg,jpeg',
                'mobile' => ['required'],
                // 'certificate' => ['required', 'mimes:pdf']
            ]);
            DB::beginTransaction();
        try {
            $student_count = User::where('role_id', 4)->count();
            $num_padded = sprintf("%05d", ($student_count + 1));
            $id_no = 'LLST' . $num_padded;

            $password = generatePassword(6);

            $image = $request['image'];
            // $imageName = imageUpload($image, 'profile_image');

            // Store student details
            $user = new User();
            $user->first_name = $request['first_name'];
            $user->last_name = $request['last_name'];
            $user->email = $request['email'];
            $user->mobile = $request['mobile'];
            $user->id_no =  $id_no;
            $user->dob = $request['dob'];
            $user->gender = $request['gender'];
            $user->password = Hash::make($password);
            // $user->image = $imageName;
            $user->video_id = $request['class'];
            $user->registration_type = 4;
            $user->country_code = $request['country_code'];
            $user->status = 1;
            $user->rejected = 0;
            $user->save();

            $user_id = $user->id;

            /**
             * Notification sent to inform the registered users
             */
            systemNotification::route('mail', $user->email)->notify(new RegistrationSuccessMail($user));
            /**
             * Notification sent to inform about credential
             */
            systemNotification::route('mail', $user->email)->notify(new WelcomeMailForPaidUsers($user,$password));
            createNotification($user_id, 0, 0, 'student_registration');

            // Fee generate
            $feedata = [];
            if($user->video_id > 0){
                $video_details= Video::where('id', $request['class'])->first();
                if ($video_details) {
                    $feedata[] = [
                        'user_id' => $user->id,
                        'class_id' => 0,
                        'course_id' => 0,
                        'paid_video_id' => $video_details->id,
                        'fee_type' => 'paid_video_fee',
                        'payment_month' => date("F"),
                        'amount' => $video_details->amount,
                    ];
                }
            }

            if (count($feedata) > 0) {
                DB::table('fees')->insert($feedata);
            }

            //Store certificate
            // $certificate_image =  imageUpload($request['certificate'], 'student_certificate');
            // $certificate = new Certificate();
            // $certificate->user_id = $user->id;
            // $certificate->image = $certificate_image;
            // $certificate->save();

            // $admin_details = User::select('email')->where('role_id', 1)->first();
            // $admin_email = $admin_details['email'];
            $admin_email = "abcd12300@yopmail.com";
            $email_data = array(
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'email' => $request['email'],
                'id_no' => $id_no,
                'user_type' => 'student'
            );
            // FacadesNotification::route('mail', $admin_email)->notify(new NewUserInfo($email_data));

            DB::commit();
            return redirect()->route('login')->with('success', 'Your registration is successful, now you can login');
        } catch (Exception $e) {
            dd($e);
            DB::rollback();
            return 0;
        }
        }
    }
}
