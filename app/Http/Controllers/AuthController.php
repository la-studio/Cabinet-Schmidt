<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Http\Requests;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect('admin/dashboard');
        } else {
            return redirect('login');
        }
    }
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect('login');
    }
    public function register()
    {
        Auth::logout(); // DON'T flush the session here ! Otherwise when you'll try to reach the register route from the panel, you'll be redirected my the middleware.
        return view('auth.register');
    }
}
