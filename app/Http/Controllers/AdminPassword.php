<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminPassword extends Controller
{
    //Change admin password
    public function changePassword() {
        return view('admin.body.changePassword');
    }
}
