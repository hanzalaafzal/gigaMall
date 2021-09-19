<?php

namespace App\Http\Controllers;

use App\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Payments;
use App\Package;
use Auth;
use App\Country;
use App\Categories;
use App\ShopCategory;
use App\WebmasterSection;
use File;
use App\ProductType;
use Carbon;
use App\State;
use App\City;
use App\Product;
use App\Cart;
use App\User;
use App\Favourite;
use Hash;

use DB;

class ShopController extends Controller
{
    public function approveShopper(){
        $shoppers = DB::table('users')->where('permissions_id',3)->where('status',0)->get();
        return view('backEnd.shops.shoppers',compact('shoppers'));
    }

    public function approveShopperId($id){
        DB::table('users')->where('id',$id)->update([
            'status' => 1
        ]);

        return redirect()->back()->with('message','Successfully Approved');
    }

    public function approveWithdraw(){
        $shoppers = DB::table('withdraw_requests')->where('status',0)->get();
        return view('backEnd.shops.withdraws',compact('shoppers'));
    }

    public function approveWithdrawId($id){
        DB::table('withdraw_requests')->where('id',$id)->update([
            'status' => 1
        ]);

        return redirect()->back()->with('message','Successfully Approved');
    }

    public function create_slug($slug){
        $slug = strtolower($slug);
        $slug=preg_replace("/[^A-Za-z0-9\-]/", ' ', $slug);
        $slug = preg_replace('/\s+/', '-', $slug);
        $count = 0;
        for ($i=0; $count == 0 ; $i++) {
            $check_slug = Shop::where('slug',$slug)->get();
            if (count($check_slug) > 0) {
                $slug .= '-'.rand(0,99);
            }
            else
                $count = 1;
        }
        return $slug;
    }

    public function create()
    {
        if(empty(Auth::user()->first_name) || empty(Auth::user()->last_name)){
            return redirect()->route('dashboard')->with('errorMessage','Please update your profile first.');
        }

        $payments = Payments::where('user_id',Auth::user()->id)
                            ->where('status','Available')
                            ->orderBy('package_id')
                            ->get();

        $package = Package::find(1);
		$countries = Country::where('id','147')->get();
        /* $countries = Country::all(); */

        return view('frontEnd.vendor.shops.create',compact('payments','countries','package'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'payment_id' => 'required',
            'title' => 'required|max:50|min:5',
            'description' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'password' => 'required',
            'address' => 'required',
            'currency' => 'required',
        ]);

        if(!Hash::check($request->password, Auth::user()->password)){
            return back()->with('errorMessage','Wrong Password! Please give your correct account password.');
        }

        $payment = Payments::where('id',$request->payment_id)
                            ->where('user_id',Auth::user()->id)
                            ->where('status','Available')
                            ->first();

        if(count($payment) == 0 && $request->payment_id != 0){
            return redirect()->back()->with('warningMessage','Something Went Wrong!');
        }

        // Create Slug
        $slug = $this->create_slug($request->title);

        // Store Shop
        $shop = new Shop();
        $shop->user_id = Auth::user()->id;
        $shop->title = $request->title;
        $shop->description = $request->description;
        $shop->country_id = $request->country_id;
        $shop->state_id = $request->state_id;
        $shop->city_id = $request->city_id;
        $shop->currency = $request->currency;
        $shop->slug = $slug;
        $shop->address = $request->address;
        $shop->password = $request->password;
        $shop->ref_code_used = $request->referral_code;
        $shop->status = 'Pending';

        //Use Payment
        if ($request->payment_id == 0) {
            $shop->package_id = 1;
        }
        else{
            $payment->status = 'Used';
            $payment->save();
            $shop->package_id = $payment->packages->id;
        }

        if(!empty(request()->file('photo'))) {
            $destinationPath = base_path() . '/public/frontEnd/images/shops';
            $extension = request()->file('photo')->getClientOriginalExtension();
            $fileName = 'shop-photo-'.time().rand(). $shop->id . '.' . $extension;
            request()->file('photo')->move($destinationPath, $fileName);
            $shop->photo = $fileName;
        }

        $shop->save();

        return redirect()->route('myShops')->with('doneMessage',"Shop Created Successfully!");
    }

    public function edit($slug){
        $shop = Shop::where('slug',$slug)->where('user_id',Auth::user()->id)->where('status','!=','Deleted')->first();
        if (count($shop)==0) {
            return redirect()->back()->with('errorMessage','Shop Not Found!');
        }
        $countries = Country::all();
        $states = State::where('country_id',$shop->country_id)->get();
        $cities = City::where('state_id',$shop->state_id)->get();
        return view('frontEnd.vendor.shops.edit',compact('shop','countries','cities','states'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:25|min:5',
            'description' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'currency' => 'required',
        ]);

        // Store Shop
        $shop = Shop::where('slug',$request->slug)->where('status','!=','Deleted')->where('user_id',Auth::user()->id)->first();

        if (count($shop) == 0) {
           return redirect()->back()->with('errorMessage','Shop Not Found!');
        }

        $shop->title = $request->title;
        $shop->description = $request->description;
        $shop->country_id = $request->country_id;
        $shop->state_id = $request->state_id;
        $shop->city_id = $request->city_id;
        $shop->currency = $request->currency;

        if(!empty(request()->file('photo'))) {

          unlink(base_path().'/public/frontEnd/images/shops/'.$shop->photo);

          $destinationPath = base_path() . '/public/frontEnd/images/shops';
          $extension = request()->file('photo')->getClientOriginalExtension();
          $fileName = 'shop-photo-'.time().rand(). $shop->id . '.' . $extension;
          request()->file('photo')->move($destinationPath, $fileName);

          $shop->photo = $fileName;
        }
        $shop->save();

        return redirect()->route('myShops')->with('doneMessage',"Shop Updated Successfully.");
    }

    public function myShops(){
        $count['all'] = Shop::where('user_id',Auth::user()->id)->where('status','!=','Deleted')->count();
        $count['active'] = Shop::where('user_id',Auth::user()->id)->where('status','Active')->count();
        $count['pending'] = Shop::where('user_id',Auth::user()->id)->where('status','Pending')->count();
        $count['disable'] = Shop::where('user_id',Auth::user()->id)->where('status','Disable')->count();
        $count['renewal'] = Shop::where('user_id',Auth::user()->id)->where('status','Renewal')->count();
        $shops = Shop::where('user_id',Auth::user()->id)->where('status','!=','Deleted')->paginate(20);
        return view('frontEnd.vendor.shops.my_shops',compact('shops','count'));
    }
    public function myShopsActive(){
        $count['all'] = Shop::where('user_id',Auth::user()->id)->where('status','!=','Deleted')->count();
        $count['active'] = Shop::where('user_id',Auth::user()->id)->where('status','Active')->count();
        $count['pending'] = Shop::where('user_id',Auth::user()->id)->where('status','Pending')->count();
        $count['disable'] = Shop::where('user_id',Auth::user()->id)->where('status','Disable')->count();
        $count['renewal'] = Shop::where('user_id',Auth::user()->id)->where('status','Renewal')->count();

        $shops = Shop::where('user_id',Auth::user()->id)
                    ->where('status','Active')
                    ->paginate(20);
        return view('frontEnd.vendor.shops.my_shops',compact('shops','count'));
    }
    public function myShopsPending(){
        $shops = Shop::where('user_id',Auth::user()->id)
                    ->where('status','Pending')
                    ->paginate(20);
        $count['all'] = Shop::where('user_id',Auth::user()->id)->where('status','!=','Deleted')->count();
        $count['active'] = Shop::where('user_id',Auth::user()->id)->where('status','Active')->count();
        $count['pending'] = Shop::where('user_id',Auth::user()->id)->where('status','Pending')->count();
        $count['disable'] = Shop::where('user_id',Auth::user()->id)->where('status','Disable')->count();
        $count['renewal'] = Shop::where('user_id',Auth::user()->id)->where('status','Renewal')->count();
        return view('frontEnd.vendor.shops.my_shops',compact('shops','count'));
    }
    public function myShopsDisable(){
        $shops = Shop::where('user_id',Auth::user()->id)
                    ->where('status','Disable')
                    ->paginate(20);
        $count['all'] = Shop::where('user_id',Auth::user()->id)->where('status','!=','Deleted')->count();
        $count['active'] = Shop::where('user_id',Auth::user()->id)->where('status','Active')->count();
        $count['pending'] = Shop::where('user_id',Auth::user()->id)->where('status','Pending')->count();
        $count['disable'] = Shop::where('user_id',Auth::user()->id)->where('status','Disable')->count();
        $count['renewal'] = Shop::where('user_id',Auth::user()->id)->where('status','Renewal')->count();
        return view('frontEnd.vendor.shops.my_shops',compact('shops','count'));
    }
    public function myShopsRenewal(){
        $shops = Shop::where('user_id',Auth::user()->id)
                    ->where('status','Renewal')
                    ->paginate(20);
        $count['all'] = Shop::where('user_id',Auth::user()->id)->where('status','!=','Deleted')->count();
        $count['active'] = Shop::where('user_id',Auth::user()->id)->where('status','Active')->count();
        $count['pending'] = Shop::where('user_id',Auth::user()->id)->where('status','Pending')->count();
        $count['disable'] = Shop::where('user_id',Auth::user()->id)->where('status','Disable')->count();
        $count['renewal'] = Shop::where('user_id',Auth::user()->id)->where('status','Renewal')->count();
        return view('frontEnd.vendor.shops.my_shops',compact('shops','count'));
    }










    ////////////// Admin Functions //////////////////////

    public function approveList(){
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $shops = Shop::where('status','Pending')->orderBy('updated_at','acs')->get();
        return view('backEnd.shops.list',compact('shops','GeneralWebmasterSections'));
    }
    public function approve($id){
        $shop = Shop::find($id);
        $shop->status = 'Active';
        $shop->end_date = Carbon\Carbon::now()->addMonth();
        $shop->save();
        return redirect()->back()->with('doneMessage','Shop Approved Successfully');
    }


    public function getApprovalListAffialiators(){
      $users=User::where('permissions_id','=','5')->orderBy('id','DESC')->get();
      return view('backEnd.affiliator.list',compact('users'));
    }

    public function approveAffiliator($id,$newStatus){
      $user=User::find($id);

      if($newStatus==1){
        $user->status=1;
      }else{
        $user->status=0;
      }

      $user->save();
      return redirect()->back()->with('doneMessage','Affiliator Approved');
    }

    public function disable($id){
        $shop = Shop::find($id);
        $shop->status = 'Disable';
        $shop->save();

        $products = Product::where('shop_id',$shop->id)->get();
        if (count($products)>0) {
            foreach ($products as $product) {
                $product->status = 'Disable';
                $product->save();

                $cart = Cart::where('product_id',$product->id)->delete();
                $fav = Favourite::where('product_id',$product->id)->delete();
            }
        }
        return redirect()->back()->with('doneMessage','Shop Disabled Successfully');
    }

    public function active($id){
        $shop = Shop::find($id);
        $shop->status = 'Active';
        $shop->save();

        $products = Product::where('shop_id',$shop->id)->get();
        if (count($products)>0) {
            foreach ($products as $product) {
                $product->status = 'Active';
                $product->save();
            }
        }
        return redirect()->back()->with('doneMessage','Shop Active Successfully');
    }

    public function delete($id){
        $shop = Shop::find($id);
        $shop->status = 'Deleted';
        $shop->save();

        $products = Product::where('shop_id',$shop->id)->get();
        if (count($products)>0) {
            foreach ($products as $product) {
                $product->status = 'Deleted';
                $product->save();

                $cart = Cart::where('product_id',$product->id)->delete();
                $fav = Favourite::where('product_id',$product->id)->delete();
            }
        }
        return redirect()->back()->with('doneMessage','Shop Deleted Successfully');
    }

    //Details
    public function shopsAll(){
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $count['All'] = Shop::count();
        $count['Active'] = Shop::where('status','Active')->count();
        $count['Disable'] = Shop::where('status','Disable')->count();
        $count['Pending'] = Shop::where('status','Pending')->count();
        $count['Renewal'] = Shop::where('status','Renewal')->count();
        $count['Deleted'] = Shop::where('status','Deleted')->count();

        $shops = Shop::orderBy('updated_at','acs')->paginate(10);
        return view('backEnd.details.shops_list',compact('count','shops','GeneralWebmasterSections'));
    }

    public function shopsActive(){
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $count['All'] = Shop::count();
        $count['Active'] = Shop::where('status','Active')->count();
        $count['Disable'] = Shop::where('status','Disable')->count();
        $count['Pending'] = Shop::where('status','Pending')->count();
        $count['Renewal'] = Shop::where('status','Renewal')->count();
        $count['Deleted'] = Shop::where('status','Deleted')->count();

        $shops = Shop::where('status','Active')->orderBy('updated_at','acs')->paginate(10);
        return view('backEnd.details.shops_list',compact('count','shops','GeneralWebmasterSections'));
    }

    public function shopsPending(){
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $count['All'] = Shop::count();
        $count['Active'] = Shop::where('status','Active')->count();
        $count['Disable'] = Shop::where('status','Disable')->count();
        $count['Pending'] = Shop::where('status','Pending')->count();
        $count['Renewal'] = Shop::where('status','Renewal')->count();
        $count['Deleted'] = Shop::where('status','Deleted')->count();

        $shops = Shop::where('status','Pending')->orderBy('updated_at','acs')->paginate(10);
        return view('backEnd.details.shops_list',compact('count','shops','GeneralWebmasterSections'));
    }

    public function shopsDisable(){
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $count['All'] = Shop::count();
        $count['Active'] = Shop::where('status','Active')->count();
        $count['Disable'] = Shop::where('status','Disable')->count();
        $count['Pending'] = Shop::where('status','Pending')->count();
        $count['Renewal'] = Shop::where('status','Renewal')->count();
        $count['Deleted'] = Shop::where('status','Deleted')->count();

        $shops = Shop::where('status','Disable')->orderBy('updated_at','acs')->paginate(10);
        return view('backEnd.details.shops_list',compact('count','shops','GeneralWebmasterSections'));
    }

    public function shopsRenewal(){
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $count['All'] = Shop::count();
        $count['Active'] = Shop::where('status','Active')->count();
        $count['Disable'] = Shop::where('status','Disable')->count();
        $count['Pending'] = Shop::where('status','Pending')->count();
        $count['Renewal'] = Shop::where('status','Renewal')->count();
        $count['Deleted'] = Shop::where('status','Deleted')->count();

        $shops = Shop::where('status','Renewal')->orderBy('updated_at','acs')->paginate(10);
        return view('backEnd.details.shops_list',compact('count','shops','GeneralWebmasterSections'));
    }

    public function shopsDeleted(){
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $count['All'] = Shop::count();
        $count['Active'] = Shop::where('status','Active')->count();
        $count['Disable'] = Shop::where('status','Disable')->count();
        $count['Pending'] = Shop::where('status','Pending')->count();
        $count['Renewal'] = Shop::where('status','Renewal')->count();
        $count['Deleted'] = Shop::where('status','Deleted')->count();

        $shops = Shop::where('status','Deleted')->orderBy('updated_at','acs')->paginate(10);
        return view('backEnd.details.shops_list',compact('count','shops','GeneralWebmasterSections'));
    }

    //Search
    public function searchShops(Request $request){
        return redirect()->route('searchShopsSlug',$request->name);
    }
    public function searchShopsSlug($title){
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $shops = Shop::where('title', 'like', '%' . $title . '%')->paginate(10);

        $count['All'] = Shop::count();
        $count['Active'] = Shop::where('status','Active')->count();
        $count['Disable'] = Shop::where('status','Disable')->count();
        $count['Pending'] = Shop::where('status','Pending')->count();
        $count['Renewal'] = Shop::where('status','Renewal')->count();
        $count['Deleted'] = Shop::where('status','Deleted')->count();

        return view('backEnd.details.shops_list',compact('shops','count','GeneralWebmasterSections'));
    }

    //Featured
    public function shopsFeaturedCreate($id){
        $shop = Shop::find($id);
        $shop->is_featured = 1;
        $shop->save();
        return redirect()->back()->with('doneMessage','Shop Featured!');
    }
    public function shopsUnFeatured($id){
        $shop = Shop::find($id);
        $shop->is_featured = 0;
        $shop->save();
        return redirect()->back()->with('doneMessage','Shop Removed From Featured!');
    }

    public function editShopAdmin($id){
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $shop = Shop::find($id);
        return view('backEnd.shops.edit',compact('shop','GeneralWebmasterSections'));
    }

    public function updateShopAdmin(Request $request){
        $this->validate($request, [
            'id' => 'required',
            'name' => 'required|max:50|min:5',
            'description' => 'required',
            'address' => 'required',
        ]);

        // Store Shop
        $shop = Shop::find($request->id);
        $shop->title = $request->name;
        $shop->description = $request->description;
        $shop->address = $request->address;
        $shop->save();

        $user = User::find($shop->user_id);
        $user->phone = $request->phone;
        $user->save();

        return redirect()->back()->with('doneMessage','Shop updated Successfully!');
    }










    //Api
    public function apiGetShops(){
        $shops = Shop::all();
        return response()->json($shops);
    }

}
