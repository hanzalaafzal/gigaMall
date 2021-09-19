<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactUs;
use Auth;
use App\WebmasterSection;

class ContactUsController extends Controller
{
	public function contactUs(Request $request){
		$this->validate($request, [
            'full_name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);

		$contact = new ContactUs();
		$contact->full_name = $request->full_name;
		$contact->email = $request->email;
		$contact->message = $request->message;
		$contact->status = 1;
		$contact->save();

		return redirect()->back()->with('doneMessage','Message Sent!');
	}

	public function contactUsMessages(){
		$messages = ContactUs::where('status',1)->get();

		$GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();

		return view('backEnd.contactus.messages',compact('messages','GeneralWebmasterSections'));
	}
}
