<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use App\Models\Subject;


use Mail;

class HomeController extends Controller
{
    //
    public function index()
    {
        return view('admin.dashboard');
    }

    

}
