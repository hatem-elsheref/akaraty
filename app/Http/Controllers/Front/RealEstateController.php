<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\SupportMail;
use App\Models\Contact;
use App\Models\RealEstate;
use App\Models\State;
use App\Rules\ValidateEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RealEstateController extends Controller
{

    public function index(){
        $data['real_states']=$this->search();
        return view('front.pages.listing',$data);
    }
    public function searchByType($type){
        if (in_array(strtolower($type),array_keys(buildingTypes())) || strtolower($type) == 'any'){
            if (strtolower($type) == 'any')
                $data['real_states']=$this->search();
            else
                $data['real_states']=$this->search('type',strtolower($type));

            return view('front.pages.listing',$data);
        }else{
            fail('Un Defined Building Type');
            return redirect()->back();
        }
    }
    public function searchByCategory($category){
        if (in_array($category,category())){
            $data['real_states']=$this->search('category',$category);
            return view('front.pages.listing',$data);
        }else{
            fail('Un Defined Category');
            return redirect()->back();
        }
    }
    public function searchByState($id){
        $state=State::findOrFail($id);
        $data['real_states']=$this->search('state_id',$state->id);
        return view('front.pages.listing',$data);
    }
    public function searchByPrice($price){

        if ($price == 'low-high'){
            $data['real_states']=$this->search(null,null,'price','asc');
        }elseif ($price == 'high-low'){
            $data['real_states']=$this->search(null,null,'price','desc');
        }else{
            fail('Un Defined Price');
            return redirect()->back();
        }

        return view('front.pages.listing',$data);
    }
    public function getDetails($slug){
        $real_state=RealEstate::with('owner','state','state.country','images')->where('slug',$slug)->where('status','=','available')->firstOrFail();
        $related=RealEstate::with('owner','state','state.country','images')->where('category',$real_state->category)->where('status','=','available')
            ->where('id','!=',$real_state->id)->orderByDesc('id')->take(3)->get();
        return view('front.pages.details',compact('real_state'))->with('related',$related);
    }

    public function searchFilter(Request $request){
        $results=RealEstate::query();
        $results->with('owner','state','state.country','images')->where('status','=','available');
        if ($request->has('category') && $request->type =='on'){
            $results->where('category','buy');
        }
        if ($request->has('states') && is_array($request->states)){
            $results->whereIn('state_id',$request->states);
        }
        if ($request->has('building_type') && in_array(strtolower($request->building_type),array_keys(buildingTypes()))){
            $results->where('type',strtolower($request->building_type));
        }elseif (strtolower($request->building_type) == 'any'){
            $results->whereIn('type',array_keys(buildingTypes()));
        }
        if ($request->has('bed') && is_numeric($request->bed)){
            $results->where('bed_room_number',$request->bed);
        }elseif($request->bed =='+5'){
            $results->where('bed_room_number','>=',5);
        }
        if ($request->has('bath') && is_numeric($request->bath)){
            $results->where('bath_room_number',$request->bath);
        }elseif($request->bath =='+5'){
            $results->where('bath_room_number','>=',5);
        }
        if ($request->has('price') && !empty($request->price)){
            $priceParts=explode(';',$request->price);
            $min=$priceParts[0];
            $max=$priceParts[1];
            $results->whereBetween('price',[$min,$max]);
        }
        if ($request->has('area') && !empty($request->area)){
            $areaParts=explode(';',$request->area);
            $min=$areaParts[0];
            $max=$areaParts[1];
            $results->whereBetween('area',[$min,$max]);
        }
        $results->orderByDesc('id');
        return view('front.pages.listing',['real_states'=>$results->paginate(PAGINATION)]);
    }
    private function search($column=null,$value=null,$orderBy='created_at',$method='desc'){
        $real_states=RealEstate::with('owner','state','state.country','images')->where('status','=','available')->orderBy($orderBy,$method);
        if ($column && $value)
            $real_states=$real_states->where($column,$value);
        return $real_states->paginate(PAGINATION);
    }
    public function contact(Request $request){

        $request->validate([
            'name'=>'required|string|max:191',
            'email'     =>['required','email','max:191',new ValidateEmail()],
            'phone'     =>['required','numeric'],
            'message'   =>'required|string',
        ]);
        $item=RealEstate::where('slug',$request->item)->where('status','=','available')->firstOrFail();
        $validatedData=$request->except('_token');
        $validatedData['user_id']=$item->user_id;
        $validatedData['for']='owner';
        $validatedData['realEstate']=$item->id;
        $contact=Contact::create($validatedData);
        success();
        Mail::to($contact->user->email)->send(new SupportMail($contact,$contact->real_estate->title,$contact->real_estate->address));
        return redirect()->back()->with('response',['type'=>'success','message'=>'Message Sent Successfully']);
    }
}
