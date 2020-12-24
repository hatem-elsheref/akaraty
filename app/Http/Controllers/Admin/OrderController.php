<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Mail\RealEstateOrderApproved;
use App\Models\ArchievedOrder;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    private function getOrderes($status){
        $orders=Order::query();
        $orders->where('status',$status)->where('owner_id',auth()->id())->with(['user','realEstate']);
        return $orders->orderByDesc('id')->orderByDesc('real_estate_id');
    }
    public function pending(){
        $orders=$this->getOrderes(PENDING)->paginate(PAGINATION);
        return view('admin.owner.orders.index',compact('orders'))->with('type','Pending');
    }
    public function approved(){
        $orders=$this->getOrderes(APPROVED)->paginate(PAGINATION);
        return view('admin.owner.orders.index',compact('orders'))->with('type','Approved');
    }

    public function allOperations(){
        $orders=ArchievedOrder::with('user','originalOrder','realEstate')->orderByDesc('created_at')->paginate(PAGINATION);
        return view('admin.owner.orders.archive',compact('orders'))->with('type','Previous ');
    }



    public function destroy($id){
        $order=ArchievedOrder::with('originalOrder')->findOrFail($id);
        $order->originalOrder->delete();
        success();
        return redirect()->back();
    }


    public function cancel($id){
        $order= Order::findOrFail($id);
        $order->status='canceled';
        $order->original_order=$order->id;
        ArchievedOrder::create($order->toArray());
        $order->delete();
        success();
        return redirect()->back();
    }

    public function approve($id){
        $order= Order::findOrFail($id);
        $realEstate=$order->realEstate;
        if ($realEstate->category == 'rent'){
            $order->status='renting';
            $realEstate->status='busy';
            $realEstate->start_rent_date=now();
            $realEstate->end_rent_date=now()->addMonths($order->months);
        }else{
            $order->status='buying';
            $realEstate->status='sold';
            $realEstate->buy_date=now();
        }
        $realEstate->save();
        $order->real_estate_at_this_time=serialize($realEstate->toArray());
        $order->original_order=$order->id;
        ArchievedOrder::create($order->toArray());
        $canceled=Order::where('real_estate_id',$order->real_estate_id)->where('id','!=',$order->id)->get();
        foreach ($canceled as $item){
            $item->status='canceled';
            $item->real_estate_at_this_time=serialize($realEstate->toArray());
            $item->original_order=$order->id;
            ArchievedOrder::create($item->toArray());
            $item->delete();
        }
        unset($order->real_estate_at_this_time);
        unset($order->original_order);
        $order->status='approved';
        $order->save();
        Mail::to($order->user->email)->send(new RealEstateOrderApproved($order));
        success();
        return redirect()->back();
    }
}
