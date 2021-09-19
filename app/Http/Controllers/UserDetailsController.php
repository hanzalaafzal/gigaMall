<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\AddressBook;
use App\User;
use Hash;
use App\wallet;
use App\Shop;
use DB;

class UserDetailsController extends Controller
{

    public function storeShopper(Request $request)
    {
        //
        $this->validate($request, [
            'business_name' => 'required',
            'cnic' => 'required|integer',
            'province' => 'required',
            'city' => 'required',
            'shop_address' => 'required',
            'mobile_number' => 'required',
        ]);



        $shopper = DB::Table('shopper_details')->where('user_id',auth()->user()->id)->first();
        if($shopper){
            DB::Table('shopper_details')->where('user_id',auth()->user()->id)->update([
                'business_name' => $request->business_name,
                'cnic' => $request->cnic,
                'province' => $request->province,
                'city' => $request->city,
                'shop_address' => $request->shop_address,
                'ntn' => $request->ntn,
                'stn' => $request->stn,
                'mobile_number' => $request->mobile_number,
            ]);
        }else{
            DB::Table('shopper_details')->insert([
                'user_id' => auth()->user()->id,
                'business_name' => $request->business_name,
                'cnic' => $request->cnic,
                'province' => $request->province,
                'city' => $request->city,
                'shop_address' => $request->shop_address,
                'ntn' => $request->ntn,
                'stn' => $request->stn,
                'mobile_number' => $request->mobile_number,
            ]);
        }

        return redirect()->back()->with('doneMessage', trans('backLang.addDone'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'phone' => 'required',
            'photo' => 'mimes:jpeg,jpg,png,gif|dimensions:min_width=1080,min_height=1080',
        ]);
        $allData=$request->all();
//var_dump($allData);die();
        $user = User::find(Auth::user()->id);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;

        if(!empty(request()->file('photo'))) {
            if (!empty($user->photo)) {
                unlink(base_path().'/public/frontEnd/images/avatars/'.$user->photo);
            }
          $destinationPath = base_path() . '/public/frontEnd/images/avatars';
          $extension = request()->file('photo')->getClientOriginalExtension();
          $fileName = 'user-avatar-'.time().rand(). $user->id . '.' . $extension;
          request()->file('photo')->move($destinationPath, $fileName);
          
          $user->photo = $fileName;
        }

        $user->save();

        return redirect()->back()->with('doneMessage','Profile Information Updated!');
    }

    public function storeAddress(Request $request){
        $this->validate($request, [
            'full_name' => 'required',
            'phone' => 'required',
            'zip_code' => 'required',
            'country_id' => 'required',
            'address' => 'required',
        ]);

        $check_default = AddressBook::where('user_id',Auth::user()->id)->where('status','Default')->first();

        $address = new AddressBook();
        $address->user_id = Auth::user()->id;
        $address->full_name = $request->full_name;
        $address->phone = $request->phone;
        $address->zip_code = $request->zip_code;
        $address->country_id = $request->country_id;
        $address->address = $request->address;
        if(count($check_default) == 0 ){
            $address->status = 'Default';
        }
        else{
            $address->status = 'Active';
        }
        $address->save();
        
        return redirect()->back()->with('doneMessage','Address Added!');
    }

    public function updateAddress(Request $request){
        $this->validate($request, [
            'full_name' => 'required',
            'phone' => 'required',
            'zip_code' => 'required',
            'country_id' => 'required',
            'address' => 'required',
        ]);

        $address = AddressBook::find($request->id);

        if (count($address)>0) {
            $address->full_name = $request->full_name;
            $address->phone = $request->phone;
            $address->zip_code = $request->zip_code;
            $address->country_id = $request->country_id;
            $address->address = $request->address;
            $address->save();
            return redirect()->back()->with('doneMessage','Address Updated!');
        }
        else{
            return redirect()->back()->with('errorMessage','Address Not Found!');
        }
    }

    public function deleteAddress($id){
        $address = AddressBook::where('user_id',Auth::user()->id)->where('status','Active')->where('id',$id)->first();
        if (count($address) > 0) {
            $address->delete();
            return redirect()->back()->with('doneMessage','Address Removed!');
        }
        else
            return redirect()->back()->with('errorMessage','Address Not Found!');

    }


    //Vendor Reset Password
    public function vendorResetPassword(){
        return view('frontEnd.vendor.reset-password');
    }
    public function clientResetPassword(){
        return view('frontEnd.client.reset-password');
    }

    //Update Password
    public function ResetPasswordUpdate(Request $request){
        $this->validate($request, [
            'old_password'     => 'required',
            'new_password'     => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);

        $user = User::find(Auth::user()->id);

        if(!Hash::check($request->old_password, $user->password)){
            return back()->with('errorMessage','The specified password does not match the old password');
        }else{
           $user->password = bcrypt($request->new_password);
           $user->save();
           return back()->with('doneMessage','Password Updated!');
        }
    }

    // Get Address
    public function getAddress($id){
        $address = AddressBook::where('user_id',Auth::user()->id)->where('id',$id)->first();
        $address['country'] = $address->countries->title_en;
        return response()->json($address); 
    }

}
