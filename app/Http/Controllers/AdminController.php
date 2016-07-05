<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Http\Requests;
use Auth;

class AdminController extends Controller
{

    public function index()
    {
        return view('admin.dashboard_body');
    }

}
