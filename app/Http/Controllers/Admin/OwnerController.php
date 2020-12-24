<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RealEstate;
use Illuminate\Http\Request;
use App\Models\User;

class OwnerController extends Controller
{
    public function index(Request $request){
        $owners=User::with(['plan'])->where('role',OWNER)->where(function ($query) use($request){
            $query->when($request->search,function ($q) use ($request){
                $q->where('name','like','%'.$request->search.'%')
                    ->orWhere('plan_id',$request->search)
                    ->orWhere('email','like','%'.$request->search.'%');
            });
        })->orderByDesc('id')->paginate(PAGINATION);

        return view('admin.owners-view',compact('owners'));
    }

    public function realEstates(Request $request,$owner){
        $realEstates=RealEstate::with('owner','state','state.country','images')
            ->where(function ($query) use($request){
            $query->when($request->search,function ($q) use ($request){
                $q->where('title','like','%'.$request->search.'%')
                    ->orWhere('address','like','%'.$request->search.'%')
                    ->orWhere('slug','like','%'.$request->search.'%')
                    ->orWhere('category','like','%'.$request->search.'%')
                    ->orWhere('type','like','%'.$request->search.'%')
                    ->orWhere('area','=',$request->search)
                    ->orWhere('price','=',$request->search);
            });
        })->where('user_id',$owner)->orderByDesc('id')->paginate(PAGINATION);

        return view('admin.owner.real_estates.for_admin',compact('realEstates'));
    }

    public function updateStatus(Request $request,$sell){
        $seller=User::where('id',$sell)->firstOrFail();
        if ($request->id == $seller->id){
            if ($seller->status === 'blocked'){
                $seller->status='unblocked';
                $seller->save();
            }else{
                $seller->status='blocked';
                $seller->save();
            }
            success();
            return redirect()->back();
        }
        fail();
        return redirect()->back();
    }

}
