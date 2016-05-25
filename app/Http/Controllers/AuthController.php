<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;

class AuthController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
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
        return redirect('login');
    }
}
