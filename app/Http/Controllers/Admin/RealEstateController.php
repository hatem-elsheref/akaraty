<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Image;
use App\Models\RealEstate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RealEstateController extends Controller
{
    public function index(Request $request){
        $items=RealEstate::with('owner','state','state.country','images')->where(function ($query) use($request){
            $query->when($request->search,function ($q) use ($request){
                  $q->where('title','like','%'.$request->search.'%')
                    ->orWhere('address','like','%'.$request->search.'%')
                    ->orWhere('slug','like','%'.$request->search.'%')
                    ->orWhere('category','like','%'.$request->search.'%')
                    ->orWhere('type','like','%'.$request->search.'%')
                    ->orWhere('area','=',$request->search)
                    ->orWhere('price','=',$request->search);
            });
        })->where('user_id',auth()->id())->orderByDesc('id')->paginate(PAGINATION);

            return view('admin.owner.real_estates.index',['realEstates'=>$items]);
    }

    public function show($id){
        $realEstate=RealEstate::with('owner','state','state.country','images')->findOrFail($id);
        return view('admin.owner.real_estates.show',['realEstate'=>$realEstate]);
    }

    public function getByType($type){
        if (in_array(strtolower($type),array_keys(buildingTypes()))){
            $items=RealEstate::with('owner','state','state.country','images')->where('type',strtolower($type))->orderByDesc('id')->paginate(PAGINATION);
            return view('admin.owner.real_estates.index',['realEstates'=>$items]);
        }
        fail('Un Defined Type '. $type);
        return redirect()->route('real-estate.index');
    }

    private function shared(){
        return [
            'countries'=>Country::select('name','id')->get()
        ];
    }

    public function createBuilding(){
        $data=$this->shared();
        return view('admin.owner.real_estates.create_building',$data);
    }

    public function createLand(){
        $data=$this->shared();
        return view('admin.owner.real_estates.create_land',$data);
    }

    public function storeBuilding(Request $request){

        $request->category=strtolower($request->category);
        $request->validate([
          'type'         => 'required|in:apartment,building',
          'title'        => 'required|string|max:191',
//          'video'        => 'nullable|url|max:191',
          'state'        => 'required|numeric|exists:states,id',
//          'long'         => 'nullable|string',
//          'lat'          => 'nullable|string',
          'address'      => 'required|string|max:191',
          'category'     => 'required|in:buy,rent',
          'price'        => 'required|numeric|min:1',
          'area'         => 'required|numeric|min:1',
          'floors_number'=> 'required|numeric|min:1',
          'flats_number' => 'required|numeric|min:1',
          'bed_room_number'    => 'required|numeric|min:1',
          'bath_room_number'   => 'required|numeric|min:1',
          'living_room_number' => 'required|numeric|min:1',
          'has_kitchen'  => 'nullable',
          'has_cleaning' => 'nullable',
          'has_internet' => 'nullable',
          'has_parking'  => 'nullable',
          'has_garage'   => 'nullable',
          'has_pool'     => 'nullable',
          'description'  => 'required|string',
          'images'       =>'required|array',
          'images.*'     =>'image|mimes:png,jpg,jpeg,gif,webp'
        ]);


        //prepare description
//        $validatedData['description']=Purify::clean($request->description);
        $validatedData['user_id']       =auth()->id();
        $validatedData['status']        ='available';
        $validatedData['state_id']      =$request->state;
//        $validatedData['lat']           =$request->lat;
//        $validatedData['long']          =$request->long;
//        $validatedData['video']         =$request->video;
        $validatedData['title']         =$request->title;
        $validatedData['type']          =$request->type;
        $validatedData['area']          =$request->area;
        $validatedData['price']         =$request->price;
        $validatedData['category']      =$request->category;
        $validatedData['address']       =$request->address;
        $validatedData['floors_number'] =$request->floors_number;
        $validatedData['flats_number']  =$request->flats_number;
        $validatedData['description']   =$request->description;
        $validatedData['bed_room_number']    =$request->bed_room_number;
        $validatedData['bath_room_number']   =$request->bath_room_number;
        $validatedData['living_room_number'] =$request->living_room_number;
        $validatedData['has_kitchen']   =$request->has('has_kitchen');
        $validatedData['has_cleaning']  =$request->has('has_cleaning');
        $validatedData['has_internet']  =$request->has('has_internet');
        $validatedData['has_parking']   =$request->has('has_parking');
        $validatedData['has_garage']    =$request->has('has_garage');
        $validatedData['has_pool']      =$request->has('has_pool');

        $reaEstate=RealEstate::create($validatedData);
        $reaEstate->slug();


        $directory='uploads/real_estates/'.$reaEstate->id;
        // prepare images
        if ($request->hasFile('images')){
            $sources=[];
            $count=0;
            foreach ($request->file('images') as $file){
                $fileName=$this->generateNewName($reaEstate,$count,$file);
                $src=$directory.'/'.$fileName;
                $file->move($directory,$fileName);
                $sources[]=['src'=>$src,'real_estate_id'=>$reaEstate->id];
                $count++;
            }

            Image::insert($sources);
        }else{
            Storage::disk('my_desk')->move($directory,$reaEstate->slug . 0 . time() . '.' . DEFAULT_REAL_ESTATE);
            Image::create(['real_estate_id'=>$reaEstate->id,'src'=>'uploads/real_estates/'.$reaEstate->id.'/'.DEFAULT_REAL_ESTATE]);
        }

        success();
        return redirect()->route('real-estate.index');
    }

    public function storeLand(Request $request){

        $request->category=strtolower($request->category);
        $request->validate([
            'type'         => 'required|in:land',
            'title'        => 'required|string|max:191',
            'state'        => 'required|numeric|exists:states,id',
            'address'      => 'required|string|max:191',
            'category'     => 'required|in:buy',
            'price'        => 'required|numeric|min:1',
            'area'         => 'required|numeric|min:1',
            'description'  => 'required|string',
            'images'       =>'required|array',
            'images.*'     =>'image|mimes:png,jpg,jpeg,gif,webp'
        ]);


        //prepare description
//        $validatedData['description']=Purify::clean($request->description);
        $validatedData['user_id']       =auth()->id();
        $validatedData['status']        ='available';
        $validatedData['state_id']      =$request->state;
        $validatedData['title']         =$request->title;
        $validatedData['type']          =$request->type;
        $validatedData['area']          =$request->area;
        $validatedData['price']         =$request->price;
        $validatedData['category']      =$request->category;
        $validatedData['address']       =$request->address;
        $validatedData['description']   =$request->description;

        $reaEstate=RealEstate::create($validatedData);
        $reaEstate->slug();


        $directory='uploads/real_estates/'.$reaEstate->id;
        // prepare images
        if ($request->hasFile('images')){
            $sources=[];
            $count=0;
            foreach ($request->file('images') as $file){
                $fileName=$this->generateNewName($reaEstate,$count,$file);
                $src=$directory.'/'.$fileName;
                $file->move($directory,$fileName);
                $sources[]=['src'=>$src,'real_estate_id'=>$reaEstate->id];
                $count++;
            }

            Image::insert($sources);
        }else{
            Storage::disk('my_desk')->move($directory,$reaEstate->slug . 0 . time() . '.' . DEFAULT_REAL_ESTATE);
            Image::create(['real_estate_id'=>$reaEstate->id,'src'=>'uploads/real_estates/'.$reaEstate->id.'/'.DEFAULT_REAL_ESTATE]);
        }

        success();
        return redirect()->route('real-estate.index');
    }

    public function edit($id){
        $realEstate=RealEstate::with('images','state','state.country','state.country.states')->findOrFail($id);
        if ($realEstate->type == 'land')
            return view('admin.owner.real_estates.edit_land',compact('realEstate'))->with($this->shared());
        else
            return view('admin.owner.real_estates.edit_building',compact('realEstate'))->with($this->shared());
    }

    public function updateBuilding(Request $request,$id){
        $realEstate=RealEstate::with('images')->findOrFail($id);
        $request->category=strtolower($request->category);
        $request->validate([
            'type'         => 'required|in:apartment,building',
            'title'        => 'required|string|max:191',
            'state'        => 'required|numeric|exists:states,id',
            'address'      => 'required|string|max:191',
            'category'     => 'required|in:buy,rent',
            'price'        => 'required|numeric|min:1',
            'area'         => 'required|numeric|min:1',
            'floors_number'=> 'required|numeric|min:1',
            'flats_number' => 'required|numeric|min:1',
            'bed_room_number'    => 'required|numeric|min:1',
            'bath_room_number'   => 'required|numeric|min:1',
            'living_room_number' => 'required|numeric|min:1',
            'has_kitchen'  => 'nullable',
            'has_cleaning' => 'nullable',
            'has_internet' => 'nullable',
            'has_parking'  => 'nullable',
            'has_garage'   => 'nullable',
            'has_pool'     => 'nullable',
            'description'  => 'required|string',
            'images'       =>'array',
            'images.*'     =>'image|mimes:png,jpg,jpeg,gif,webp'
        ]);


        $validatedData['status']        ='available';
        $validatedData['state_id']      =$request->state;
        $validatedData['title']         =$request->title;
        $validatedData['type']          =$request->type;
        $validatedData['area']          =$request->area;
        $validatedData['price']         =$request->price;
        $validatedData['category']      =$request->category;
        $validatedData['address']       =$request->address;
        $validatedData['floors_number'] =$request->floors_number;
        $validatedData['flats_number']  =$request->flats_number;
        $validatedData['description']   =$request->description;
        $validatedData['bed_room_number']    =$request->bed_room_number;
        $validatedData['bath_room_number']   =$request->bath_room_number;
        $validatedData['living_room_number'] =$request->living_room_number;
        $validatedData['has_kitchen']   =$request->has('has_kitchen');
        $validatedData['has_cleaning']  =$request->has('has_cleaning');
        $validatedData['has_internet']  =$request->has('has_internet');
        $validatedData['has_parking']   =$request->has('has_parking');
        $validatedData['has_garage']    =$request->has('has_garage');
        $validatedData['has_pool']      =$request->has('has_pool');


        if ($realEstate->update($validatedData)){
            $realEstate->slug();
        }else{
            fail();
            return redirect()->route('real-estate.index');
        }


        $directory='uploads/real_estates/'.$realEstate->id;
        // prepare images
        if ($request->hasFile('images') && !empty($request->file('images'))){
            Storage::disk('my_desk')->deleteDirectory($directory);
            foreach ($realEstate->images as $image){
                $image->delete();
            }

            $sources=[];$count=0;
            foreach ($request->file('images') as $file){
                $fileName=$this->generateNewName($realEstate,$count,$file);
                $src=$directory.'/'.$fileName;
                $file->move($directory,$fileName);
                $sources[]=['src'=>$src,'real_estate_id'=>$realEstate->id];
                $count++;
            }

            Image::insert($sources);
        }

        success();
        return redirect()->route('real-estate.index');

    }

    public function updateLand(Request $request,$id){
        $realEstate=RealEstate::with('images')->findOrFail($id);
        $request->category=strtolower($request->category);
        $request->validate([
            'type'         => 'required|in:land',
            'title'        => 'required|string|max:191',
            'state'        => 'required|numeric|exists:states,id',
            'address'      => 'required|string|max:191',
            'category'     => 'required|in:buy',
            'price'        => 'required|numeric|min:1',
            'area'         => 'required|numeric|min:1',
            'description'  => 'required|string',
            'images'       =>'array',
            'images.*'     =>'image|mimes:png,jpg,jpeg,gif,webp'
        ]);


        $validatedData['status']        ='available';
        $validatedData['state_id']      =$request->state;
        $validatedData['title']         =$request->title;
        $validatedData['type']          =$request->type;
        $validatedData['area']          =$request->area;
        $validatedData['price']         =$request->price;
        $validatedData['category']      =$request->category;
        $validatedData['address']       =$request->address;
        $validatedData['description']   =$request->description;


        if ($realEstate->update($validatedData)){
            $realEstate->slug();
        }else{
            fail();
            return redirect()->route('real-estate.index');
        }


        $directory='uploads/real_estates/'.$realEstate->id;
        // prepare images
        if ($request->hasFile('images') && !empty($request->file('images'))){
            Storage::disk('my_desk')->deleteDirectory($directory);
            foreach ($realEstate->images as $image){
                $image->delete();
            }

            $sources=[];$count=0;
            foreach ($request->file('images') as $file){
                $fileName=$this->generateNewName($realEstate,$count,$file);
                $src=$directory.'/'.$fileName;
                $file->move($directory,$fileName);
                $sources[]=['src'=>$src,'real_estate_id'=>$realEstate->id];
                $count++;
            }

            Image::insert($sources);
        }

        success();
        return redirect()->route('real-estate.index');
    }

    public function destroy($id){
        $realEstate=RealEstate::findOrFail($id);
        Storage::disk('my_desk')->deleteDirectory('uploads/real_states/'.$realEstate->id);
        $realEstate->delete()?success():fail();
        return redirect()->route('real-estate.index');
    }

    public function getState(Request $request){
        if ($request->ajax()){
            $country=Country::with('states')->find($request->id);
            if ($country){
                return response()->json($country->states,200);
            }
            return false;
        }
        return false;
    }

    private function generateNewName($realEstate,$iterator,$file){
        return $realEstate->slug . $iterator . time() . '.' . $file->getClientOriginalExtension();
    }

    public function available($id){
        $realEstate=RealEstate::findOrFail($id);
        if ($realEstate->type != 'land' && $realEstate->category == 'rent'){
            $realEstate->status='available';
            $realEstate->start_rent_date=null;
            $realEstate->end_rent_date=null;
            $realEstate->save();
            success();
        }else{
            fail();
        }

        return redirect()->back();

    }

    public function getAllRealEstatesToAdmin(Request $request){
        $items=RealEstate::with('owner','state','state.country','images')->where(function ($query) use($request){
            $query->when($request->search,function ($q) use ($request){
                $q->where('title','like','%'.$request->search.'%')
                    ->orWhere('address','like','%'.$request->search.'%')
                    ->orWhere('slug','like','%'.$request->search.'%')
                    ->orWhere('category','like','%'.$request->search.'%')
                    ->orWhere('type','like','%'.$request->search.'%')
                    ->orWhere('area','=',$request->search)
                    ->orWhere('price','=',$request->search);
            });
        })->orderByDesc('id')->paginate(PAGINATION);

        return view('admin.owner.real_estates.for_admin',['realEstates'=>$items]);
    }
}
