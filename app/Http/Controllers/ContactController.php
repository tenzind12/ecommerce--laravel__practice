<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    // for logged in authentification
    public function __construct()
    {
        $this->middleware('auth');       
    }
    
    // contact view
    function contactView() {
        return view('contact');
    }
}
    