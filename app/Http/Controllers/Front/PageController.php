<?php

namespace App\Http\Controllers\Front;

use App\Models\Contact;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\ValidateEmail;
use Illuminate\Http\Request;


class PageController extends Controller
{

    public function aboutView(){
        return view('front.pages.about');
    }

    public function contactView(){
        return view('front.pages.contact');
    }

    public function contact(Request $request){
        $request->validate([
            'name'=>'required|string|max:191',
            'email'     =>['required','email','max:191',new ValidateEmail()],
            'phone'     =>['required','numeric'],
            'message'   =>'required|string',
        ]);
        $admin=User::where('role',ADMIN)->firstOrFail();
        $validatedData=$request->except('_token');
        $validatedData['user_id']=$admin->id;
        $validatedData['for']='admin';
        Contact::create($validatedData);
        success();
        return redirect()->back()->with('response',['type'=>'success','message'=>'Message Sent Successfully']);
    }

}
