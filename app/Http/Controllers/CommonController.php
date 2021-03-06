<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Course;
use App\Models\Event;
use App\Models\notice;
use App\Models\SpecialCourse;
use App\Models\StudentGalary;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\Video;
use App\Models\VLOG;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommonController extends Controller
{
    public function index(Request $request){
        if (Auth::check()) {
            $redirectTo = 'user/profile';
            switch (Auth::user()->role_id) {
                case 1:
                    $redirectTo = 'admin/dashboard';
                    break;
                case 2:
                    $redirectTo = 'hr/profile';
                    break;
                case 3:
                    $redirectTo = 'teacher/profile';
                    break;
                case 4:
                    $redirectTo = 'user/profile';
                    break;
                case 5:
                    $redirectTo = 'admin/dashboard';
                    break;
            }
            return redirect($redirectTo);
        } else {
            $data['events'] = Event::latest()->take(3)->get();
            $data['notices'] = notice::latest()->get();
            $data['special_courses'] = SpecialCourse::where('class_id',null)->latest()->get();
            $data['flash_courses'] = Course::latest()->take(3)->get();
            $data['student_photos'] = StudentGalary::latest()->take(8)->get();
            $data['testimonials'] = Testimonial::where('status',1)->latest()->get();
            $data['vlogs'] = VLOG::latest()->take(3)->get();
            $data['videos'] = Video::latest()->take(3)->get();
            return view('welcome')->with($data);
        }
    }

    public function availableCourses()
    {
        $data['courses'] = SpecialCourse::where('class_id',null)->latest()->paginate(9);
        return view('special_courses')->with($data);
    }
    public function flashCourses()
    {
        $data['courses'] = Course::latest()->get();
        return view('flash_courses')->with($data);
    }
    public function studentGalary()
    {
        $data['student_photos'] = StudentGalary::latest()->paginate(8);
        return view('student_galary')->with($data);
    }
    public function availableEvents()
    {
        $data['events'] = Event::latest()->paginate(9);
        return view('events')->with($data);
    }
    public function vlog()
    {
        $data['vlogs'] = VLOG::latest()->paginate(6);
        return view('vlog')->with($data);
    }
    public function vlogDetails($id)
    {
        $data['vlog_details'] = VLOG::find($id);
        return view('vlog_details')->with($data);
    }
    public function flashCourseDetails(Request $request,$id)
    {
        $data['course_details'] = Course::find($id);
        return view('flash_course_details')->with($data);
    }
    public function video()
    {
        $data['videos'] = Video::latest()->paginate(9);
        return view('video')->with($data);
    }
    public function videoDetails(Request $request,$id)
    {
        $data['videoDetails'] = Video::find($id);
        return view('video_details')->with($data);
    }

    public function getFeesByClass(Request $request){
        $class_details = Classes::where('id',$request->class_id)->first();
        if ($class_details) {
            $message = 'success';
            $res = $class_details;
        }else{
            $message = 'error';
            $res = '';
        }
        return response()->json(array(
            'msg' 	    => $message,
            'result'	=> $res
        ));
    }
    public function getCourseByClass(Request $request){
        $course_details = SpecialCourse::where('class_id',$request->class_id)->get();
        if ($course_details) {
            $message = 'success';
            $res = $course_details;
        }else{
            $message = 'error';
            $res = '';
        }
        return response()->json(array(
            'msg' 	    => $message,
            'result'	=> $res
        ));
    }

    public function getStudentByClass(Request $request){
        $class = $request->class_id;
        $after_explode_class = explode('-', $class);
        if ($after_explode_class[1] === 'class') {
            $students_details = User::where('role_id',4)->where('class',$after_explode_class[0])->latest()->get();
            return response()->json($students_details);
        }
        if ($after_explode_class[1] === 'group') {
            $students_details = User::where('role_id',4)->where('group_ids',$after_explode_class[0])->latest()->get();
            return response()->json($students_details);
        }
    }
    public function checkEmailExistence(Request $request){
        $email = $request->email;
        $already_existence = User::where('email',$email)->first();
        if ($already_existence) {
            $message = 'error';
        }else{
            $message = 'success';
        }
        return response()->json(array(
            'msg' 	    => $message
        ));

    }

    /**
     * Check mobile no existence
     */
    public function checkMobileNoExistence(Request $request){
        $mobile = $request->mobile;
        $already_existence = User::where('mobile',$mobile)->first();
        if ($already_existence) {
            $message = 'error';
        }else{
            $message = 'success';
        }
        return response()->json(array(
            'msg' 	    => $message
        ));

    }

}
