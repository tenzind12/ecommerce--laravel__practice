<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AdminPassword extends Controller
{
    //Change admin password
    public function changePassword() {
        return view('admin.body.changePassword');
    }

    // update 
    public function updatePassword(Request $request) {
        $validation = $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->old_password, $hashedPassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return Redirect()->route('login')->with('success', 'Password has been changed');
        }else {
            return Redirect()->back()->with('error', 'Password invalid');
        }

    }
}
