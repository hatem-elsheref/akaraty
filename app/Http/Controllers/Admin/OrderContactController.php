<?php

namespace App\Http\Controllers\Admin;

use App\Mail\ReplyMail;
use App\Models\Contact;
use App\Http\Controllers\Controller;
use App\Rules\ValidateEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class OrderContactController extends Controller
{
    public function index(){
        $contacts=Contact::with(['user','real_estate'])->whereIn('status',['unread','read'])
            ->where('for','owner')
            ->where('user_id',auth()->id())
            ->orderByDesc('id')->get();
        return view('admin.owner.messages.index',['contacts'=>$contacts]);
    }

    public function reply(Request $request){
        $validator=Validator::make($request->all(),
            ['email'  =>['required','email',new ValidateEmail()],
            'subject'=>'required',
            'message'=>'required']);

        if ($validator->fails()){
            fail("Please Fill All Inputs");
            return redirect()->back();
        }
        Mail::to($request->email)->send(new ReplyMail($request->subject,$request->message));
        success("Mail Sent Successfully !!");
        return redirect()->route('order_contact.index');
    }

    public function destroy($id){
        $contact=Contact::findOrFail($id);
        $contact->delete();
        success();
        return redirect()->route('order_contact.index');
    }

    public function update($id){
        $contact=Contact::findOrFail($id);
        if ($contact->status == 'read')
            $contact->status='unread';
        else
            $contact->status='read';

        $contact->save();
        success();
        return redirect()->route('order_contact.index');
    }
}
