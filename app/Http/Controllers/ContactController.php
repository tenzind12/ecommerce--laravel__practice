<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    // contact view
    function contactView() {
        return view('contact');
    }
}
    