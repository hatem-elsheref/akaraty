  // subscribe to plan and checkout
    Route::get('/subscribe-to-plan/{plan}', 'ProcessController@subscribeView')->name('checkout.plan.show')->middleware('auth');
    Route::post('/subscribe-to-plan/{plan}', 'ProcessController@checkoutPlan')->name('checkout.plan')->middleware('auth');
    Route::post('/check-before-subscribe-to-plan', 'ProcessController@ConfirmToChangeThePlan')->name('checkout.confirm');

    // booking or buy the real estate
    Route::get('/checkout', 'ProcessController@checkoutOrderView')->name('cart.checkout.view')->middleware('auth');
    Route::post('/checkout', 'ProcessController@checkoutOrder')->name('checkout.product')->middleware('auth');
-----------------------------------------------------------

Process Controller

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

        $user=auth()->user();
        if (is_null($user->plan_id)){
           $subscribedUser=Subscribe::where('user_id',$user->id)->where('plan_id',$plan->id)->first();
           if($subscribedUser){
               $message='Your Request Is Under Review Please Wait Admin To Approve Your Request';
               fail($message);
               return redirect()->back()->with('message',['content'=>$message,'type'=>'danger']);
           }
        }else{
            if($plan->id == $user->plan_id){// seller want to subscribe to a plan that is the same plan which he/she already subscribed in
                $message='You Cant Subscribe To This Plan You Are Already Subscribed..';
                fail($message);
                return redirect()->back()->with('message',['content'=>$message,'type'=>'danger']);
            }else{
                // sure the unique id and thr subscribed table
                if ($request->tmp_key !== $user->tmp_key){
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
            'company'    =>'required|string|max:191',
            'country'    =>'required|string|exists:countries,name',
            'address'    =>'required|string|max:191',
            'city'       =>'required|string|max:191',
            'postcode'   =>'required|numeric',
            'phone'      =>'required|numeric',
            'email'      =>['required','email','max:191',new ValidateEmail()],
            'gateway'    =>'required|in:cod,gateway'
        ]);

        if ($request->plan_id != $plan->id){
            return redirect()->back()->withInput()->withErrors(['plan'=>'Un Known Plan']);
        }



        $validatedData=$request->except('_token');
        $validatedData['user_id']=auth()->id();

        if (strtolower($request->gateway) == strtolower(COD)){
            $transaction=Transaction::create($validatedData);
            // make the request or plan request order
            $order=new Subscribe();
            $orderDetails=[
                'user_id'       =>auth()->id(),
                'plan_id'       =>$plan->id,
                'transaction_id'=>$transaction->id,
                'status'        =>PENDING,
                'request_is_expired'=>false
            ];
            $order->create($orderDetails);
            success();
            return redirect()->back()->with('message',['content'=>' Now Your Order Is Under Revision. Check Your Inbox ','type'=>'success']);
        }elseif (strtolower($request->gateway) == strtolower(GATEWAY)){
          abort(401);
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

//            $plan=Plan::find($request->plan_id);
//            if ($plan){
//               if (!(is_null(auth()->user()->plan_id))){
//                   if( $plan->id != auth()->user()->plan_id){// seller want to subscribe to a plan that is different from the  plan which he/she already subscribed in
//                       echo json_encode(['response'=>true,'message'=>'Do You Sure To Confirm The Processs?']);
//                   }else{
//                       echo json_encode(['response'=>false,'message'=>'You Cant Subscribe To This Plan You Already Subscribed']);
//                   }
//               }else{
//                   echo json_encode(['response'=>true,'message'=>'welcome customer']);
//               }
//            }else{
//                echo json_encode(['response'=>false,'message'=>'invalid selected plan']);
//            }

        }else{
            echo json_encode(['status'=>true]);
//            return redirect()->route('website');
        }
    }
-----------------------
