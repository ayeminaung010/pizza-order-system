<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    //contact page
    public function contactPage(){
        return view('user.contact.contact');
    }

    //contact message
    public function contact(Request $request){
      
        $this->messageValidationCheck($request);
        $data = $this->getUserData($request);
        Contact::create($data);
        return back()->with(['SendSuccess' => 'Your message sent success....']);
    }


    //private user data
    private function getUserData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now(),
        ];
    }

    //account validation check
    private function messageValidationCheck($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email'=> 'required',
            'subject'=> 'required',
            'message'=> 'required',
        ])->validate();
    }
}
