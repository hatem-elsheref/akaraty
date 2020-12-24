<?php

namespace App\Http\Controllers\Front;

use App\Mail\NewOrder;
use App\Models\Order;
use App\Models\RealEstate;
use App\Models\Subscribe;
use App\Models\Transaction;
use App\Models\User;
use App\Rules\ValidateEmail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Plan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class ProcessController extends Controller
{

    public function newsLetter(Request $request){
        $request->validate(['email'=>['required','email','max:191',new ValidateEmail()]]);
        $row=DB::table('news_letter')->insert(['email'=>$request->email]);
        ($row)?success():fail();
        return redirect()->route('website');
    }

    public function subscribeView($id){
        $plan=Plan::findOrFail($id);
        return view('front.checkout-plan',compact('plan'));
    }

    public function checkoutPlan(Request $request,$id){
        if (auth()->user()->role == ADMIN){
            fail('You Cant Subscribe In Any Plan You Are The System Admin');
            return  redirect()->back();
        }
        $plan=Plan::findOrFail($id);
        $user=User::find(auth()->id());

        if (is_null($user->plan_id)){
            $subscribedUser=Subscribe::where('user_id',$user->id)->where('plan_id',$plan->id)->first();
            if($subscribedUser){
                $message='Your Request Is Under Review Please Wait Admin To Approve Your Request';
                fail($message);
                return redirect()->back()->with('message',['content'=>$message,'type'=>'danger']);
            }
        }else{
            if($plan->id == $user->plan_id){// owner want to subscribe to a plan that is the same plan which he/she already subscribed in
                $message='You Cant Subscribe To This Plan You Are Already Subscribed..';
                fail($message);
                return redirect()->back()->with('message',['content'=>$message,'type'=>'danger']);
            }else{
                // sure the unique id and the subscribed table
                if ($request->tmp_key != $user->tmp_key){
                    $message='Invalid Operation...';
                    fail($message);
                    return redirect()->back()->with('message',['content'=>$message,'type'=>'danger']);
                }else{
                    $subscribedUser=Subscribe::where('user_id',$user->id)->where('plan_id',$plan->id)->first();
                    if($subscribedUser){
                        $message='Your Request Is Under Review Please Wait Admin To Approve Your Request';
                        fail($message);
                        return redirect()->back()->with('message',['content'=>$message,'type'=>'danger']);
                    }
                }
            }
        }


        $request->gateway=strtolower($request->gateway);
        $request->validate([
            'plan_id'    =>'required|numeric',
            'first_name' =>'required|string|max:191',
            'last_name'  =>'required|string|max:191',
            'country'    =>'required|string|exists:countries,name',
            'address'    =>'required|string|max:191',
            'postcode'   =>'required|numeric',
            'phone'      =>'required|numeric',
            'email'      =>['required','email','max:191',new ValidateEmail()],
            'gateway'    =>'required|in:cod,gateway'
        ]);

        if ($request->plan_id != $plan->id){
            return redirect()->back()->withInput()->withErrors(['plan'=>'Un Known Plan']);
        }



        $validatedData=$request->except('_token');
        $validatedData['user_id']=$user->id;

        if (strtolower($request->gateway) == strtolower(COD)){
            $transaction=Transaction::create($validatedData);
            // make the request or plan request order
            $order=new Subscribe();
            $orderDetails=[
                'user_id'       =>auth()->id(),
                'plan_id'       =>$plan->id,
                'transaction_id'=>$transaction->id,
                'status'        =>PENDING,
//                'request_is_expired'=>false
            ];
            $order->create($orderDetails);
            $user->tmp_key='undefined'; // to granted that key will no be repeated
            $user->save();

            success();
            return redirect()->back()->with('message',['content'=>'Thanks. Now Your Order Is Under Revision. Check Your Inbox ','type'=>'success']);
        }elseif (strtolower($request->gateway) == strtolower(GATEWAY)){
            abort(401,"please provide a payment gateway");
        }
    }

    public function ConfirmToChangeThePlan(Request $request){
        if ($request->ajax()){
            if (is_null($request->tmp_key)){
                echo json_encode(['status'=>false]);
            }else{
                $user=auth()->user();
                $user->tmp_key=$request->tmp_key;
                $user->save();
                echo json_encode(['status'=>true]);
            }
        }else{
            abort(500);
//            echo json_encode(['status'=>false]);
        }
    }

    public function checkoutView($id){
        $realEstate=RealEstate::where('status','=','available')->where('id',$id)->firstOrFail();
        return view('front.checkout-real-estate',compact('realEstate'));
    }

    public function checkoutProcess(Request $request){
        $realEstate=RealEstate::where('status','=','available')->where('id',$request->real_estate_id)->firstOrFail();
        if ($realEstate->status != 'available'){
            $message="Failed Operation This Item Not Available Now";
            $type='danger';
            fail($message);
            return redirect()->back()->with('response',['type'=>$type,'message'=>$message]);

        }

        $request->gateway=strtolower($request->gateway);
        $request->validate([
            'real_estate_id'=>'required|numeric',
            'first_name'    =>'required|string|max:191',
            'last_name'     =>'required|string|max:191',
            'country'       =>'required|string|exists:countries,name',
            'address'       =>'required|string|max:191',
            'postcode'      =>'required|numeric',
            'phone'         =>'required|numeric',
            'email'         =>['required','email','max:191',new ValidateEmail()],
            'gateway'       =>'required|in:cod,gateway',
            'months'        =>[Rule::requiredIf($realEstate->category == 'rent'),'nullable','numeric','min:1']
        ]);

        $validatedData=$request->except('_token');
        $validatedData['owner_id']=$realEstate->user_id;
        $validatedData['user_id'] =auth()->id();
        $validatedData['method']  =strtoupper($request->gateway);
        $validatedData['status']  ='pending';
        $validatedData['months']  =$request->months??1;
        $validatedData['total']   =$validatedData['months']*$realEstate->price;




        $condition=Order::where('user_id',auth()->id())->where('real_estate_id',$request->real_estate_id)->where('status','pending')->count();
       if ($condition == 0){
           $order=Order::create($validatedData);
           $message="Order Send Successfully Check You Inbox Soon After Owner Approve";
           $type='success';
           Mail::to($realEstate->owner->email)->send(new NewOrder($order));
           success($message);
       }else{
           $message="Failed Operation You Already Ordered This Item";
           $type='danger';
           fail($message);
       }

       return redirect()->back()->with('response',['type'=>$type,'message'=>$message]);
    }

}
