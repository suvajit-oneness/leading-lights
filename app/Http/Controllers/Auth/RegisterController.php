<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Classes;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Notifications\NewUserInfo;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Admin\Notification;
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

    public function showRegistrationForm() {
        $classes = Classes::latest()->get();
        return view ('auth.register',compact('classes'));
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
            'class' => ['required'],
            'image' => 'required| mimes:png,jpg,jpeg',
            'mobile' => ['required'],
            'certificate' => ['required','mimes:pdf']
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        // $this->guard()->login($user);

        // Notification::
        return redirect()->route('login')->with('success','Your registration is successful, waiting for admin approval');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // dd($data);
        $unique_id = $this->getCode();
        $id_no = 'LLST'.$unique_id;

        $image = $data['image'];
        $imageName = imageUpload($image,'profile_image');

        $admin_details = User::select('email')->where('role_id',1)->first();
        $admin_email = $admin_details['email'];
        $email_data = array(
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'id_no' => $id_no,
            'user_type' => 'student'
        );
        FacadesNotification::route('mail', $admin_email)->notify(new NewUserInfo($email_data));
        
        $user_creation =  User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'id_no' =>  $id_no,
            'dob'  =>  $data['dob'],
            'class' => $data['class'],
            'gender' => $data['gender'],
            'password' => Hash::make($id_no),
            'image' => $imageName
        ]);

        //Store certificate 
        $certificate_data['image'] =  imageUpload($data['certificate'],'student_certificate');

        $certificate_data['user_id'] = $user_creation->id;
        $certificate_data['created_at'] = date('Y-m-d H:i:s');
        $certificate_data['updated_at'] = date('Y-m-d H:i:s');

        DB::table('certificate')->insert($certificate_data);
        return $user_creation;
    }

    public function getCode(){
        $code = generateUniqueCode();
        $checkExisting = User::where('id_no',$code)->count();
        if ($checkExisting == 0) {
            return $code;
        }
        return $this->getCode();
    }

    public function teacher_register(Request $request){
        if ($request->method() == 'GET'){
            return view('auth.teacher_register');
        } else if($request->method() == 'POST'){
            $this->validate($request,[
                    'first_name' => ['required', 'string', 'max:255'],
                    'last_name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'doj' => ['required', 'date'],
                    'gender' => ['required'],
                    'image' => 'required| mimes:png,jpg',
                    'mobile' => ['required'],
                    'qualification' => ['required']
            ]);

            if($request->hasFile('image')){
                $image = $request->file('image');
                $imageName = imageUpload($image,'profile_image');
            }else{
                $imageName = null;
            }

            $unique_id = $this->getCode();
            $id_no = 'LLT'.$unique_id;

            $user = new User();
            $user->role_id = 3;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->doj = $request->doj;
            $user->gender = $request->gender;
            $user->id_no = $id_no;
            $user->password = Hash::make($id_no);
            $user->image = $imageName;
            $user->mobile = $request->mobile;
            $user->qualification = $request->qualification;
            $user->save();

            $admin_details = User::select('email')->where('role_id',1)->first();
            $admin_email = $admin_details['email'];
            $email_data = array(
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'id_no' => $id_no,
                'user_type' => 'teacher'
            );
            FacadesNotification::route('mail', $admin_email)->notify(new NewUserInfo($email_data));

            return redirect()->route('teacher_login')->with('success','Your registration is successful, waiting for admin approval');
        }
    }
}
