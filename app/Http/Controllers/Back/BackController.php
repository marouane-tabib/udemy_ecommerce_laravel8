<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BackController extends Controller
{
    public function index(){
        return view('back.index');
    }

    public function login(){
        return view('back.login');
    }

    public function forgot_password(){
        return view('back.forgot-password');
    }
}
