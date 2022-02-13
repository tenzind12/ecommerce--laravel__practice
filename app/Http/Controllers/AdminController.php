<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    // for loggin out 
    public function logout() {
        Auth::logout();
        return Redirect()->route('login');
    }
}
