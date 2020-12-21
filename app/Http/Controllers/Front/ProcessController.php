<?php

namespace App\Http\Controllers\Front;

use App\Rules\ValidateEmail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ProcessController extends Controller
{

    public function newsLetter(Request $request){
        $request->validate(['email'=>['required','email','max:191',new ValidateEmail()]]);
        $row=DB::table('news_letter')->insert(['email'=>$request->email]);
        ($row)?success():fail();
        return redirect()->route('website');
    }



}
