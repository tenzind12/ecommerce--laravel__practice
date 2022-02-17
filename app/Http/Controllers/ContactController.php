<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    // for logged in authentification
    public function __construct()
    {
        $this->middleware('auth');       
    }
    
    // contact view
    function adminContact() {
        $datas = DB::table('contacts')->get();
        return view('admin.contact.index', compact('datas'));
    }
}
    