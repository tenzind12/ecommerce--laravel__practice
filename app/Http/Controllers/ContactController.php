<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Contact;
use App\Models\ContactForm;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

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

    // add contact ====================== // +++++++++++++++ ==========
    public function addContact() {
        return view('admin.contact.create');
    }

    public function storeContact(Request $request) {
        $validation = $request->validate([
            'address' => 'required',
            'email' => 'required|email',
            'phone' => 'required|min:10|max:10',
        ]);

        Contact::insert([
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'created_at' => Carbon::now(),
        ]);

        return Redirect()->route('admin.contact')->with('success', 'Contact created !');
    }

    // edit contact ====================== // +++++++++++++++ ==========
    public function edit($id) {
        $contact = Contact::find($id);
        return view('admin.contact.edit', compact('contact'));
    }

    public function update(Request $request,$id) {
        $validation = $request->validate([
            'address' => 'required',
            'email' => 'required|email',
            'phone' => 'required|min:7',
        ]);
        
        $contact = Contact::find($id);
        $contact->update([
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('admin.contact')->with('success', 'Contact Updated!');
    }

    // delete contact ====================== // +++++++++++++++ ==========
    public function delete($id) {
        Contact::find($id)->delete();
        return redirect()->route('admin.contact')->with('success', 'Contact has been deleted');
    }

    // FRONT PAGE ROUTES ------------<===================> -------------------------
    // display contact page
    public function getContact() {
        $contactDetail = DB::table('contacts')->first();
        return view('pages.contact', compact('contactDetail'));
    }

    // Store contact message in db
    public function storeMessage(Request $request) {
        $validation = $request->validate([
            'name' => 'required',
            'email' => 'email|required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        ContactForm::insert([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now(),
        ]);
        return redirect()->back()->with('success', 'Your message has been sent!');
    }
}
    