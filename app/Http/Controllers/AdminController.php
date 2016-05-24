<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Http\Requests;

class AdminController extends Controller
{
    public function index() {
        return view('admin.login');
    }

    public function login()
    {
        # code...
    }

}
