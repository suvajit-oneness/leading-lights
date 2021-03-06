<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $redirectTo = 'user/profile';
        $paymentStatus = checkPaymentStatus(Auth::user()->id);
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
                if (Auth::user()->registration_type == 4 && $paymentStatus == 0) {
                    $redirectTo = 'user/payment';
                    break;
                }else{
                    $redirectTo = 'user/profile';
                    break;
                }
            case 5:
                $redirectTo = 'admin/dashboard';
                break;
        }
        return redirect($redirectTo);
        // return view('home');
    }
}
