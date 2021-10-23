<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\State;
use App\City;
use App\SubCategories;
use App\Shop;
use App\Product;
use App\Categories;
use App\User;
use Auth;
use App\Country;
use App\ProductType;
use DB;
use Session;

class GeneralController extends Controller
{
	public function getStates($country_id){
		$states = State::where('country_id',$country_id)->get();
		return response()->json($states);
	}
	public function getCities($state_id){
		$cities = City::where('state_id',$state_id)->get();
		return response()->json($cities);
	}
	public function getCategories($type_id){
		$categories = Categories::where('type_id',$type_id)->get();
		return response()->json($categories);
	}
	public function getSubCategories($category_id){
		$sub_categories = SubCategories::where('parent_id',$category_id)->get();
		return response()->json($sub_categories);
	}
	public function getSubCategoriesBySlug($slug){
		$category = Categories::where('slug',$slug)->first();
		$sub_categories = SubCategories::where('parent_id',$category->id)->get();
		return response()->json($sub_categories);
	}


	/////////////////////// Home Routes /////////////////////

	public function HomePage(){


		$categories = Categories::all();
		$featured_products['pl-1'] = Product::where('status','Active')
											->where('product_type',1)
											->where('is_featured',1)
											->orderBy('id', 'desc')
											->take(6)
											->get();
		$daily_sales = Product::where('status','Active')
											->where('daily_sale',1)
											->orderBy('id', 'desc')
											->take(6)
											->get();
		$featured_products['pl-2'] = Product::where('status','Active')
											->where('product_type',2)
											->where('is_featured',1)
											->orderBy('id', 'desc')
											->take(6)
											->get();
		$featured_products['pl-3'] = Product::where('status','Active')
											->where('product_type',3)
											->where('is_featured',1)
											->orderBy('id', 'desc')
											->take(6)
											->get();
		$featured_shops = Shop::where('status','Active')
								->where('is_featured',1)
								->orderBy('id', 'desc')
								->take(6)
								->get();

		$all_products = Product::where('status','Active')
										->orderBy('id', 'desc')
										->get();

		$slider=Product::where('is_slider','=','1')->where('status','Active')
										->orderBy('id','desc')->get();

		$admin_users = DB::table('users')->where('permissions_id',1)->get()->pluck('id');
	    $admin_products = Product::whereIn('user_id',$admin_users)
	                                    ->where('status','Active')
										->orderBy('id', 'desc')
										->get();

		return view('newFrontend.pages.home',compact('categories','featured_products','featured_shops','daily_sales','all_products','admin_products','slider'));
	}



	// How To
	public function howToShop(){
		// return view('frontEnd.general.how-to-shop');
		return view('newFrontend.pages.how-to-shop');
	}
	public function howToBuy(){
		// return view('frontEnd.general.how-to-buy');
			return view('newFrontend.pages.how-to-buy');
	}
	public function howToSell(){
		// return view('frontEnd.general.how-to-sell');
		return view('newFrontend.pages.how-to-sell');
	}

	 public function shopView($slug){
		$shop = Shop::where('slug',$slug)
					->where('status','Active')
					->orWhere('status','Renewal')
					->first();
		if (count($shop) == 0) {
			return redirect()->back();
		}
		$count['products'] = Product::where('shop_id',$shop->id)->where('status','Active')->count();
		$count['shops'] = Shop::where('user_id',$shop->user_id)->where('status','Active')->count();
		$products = Product::where('shop_id',$shop->id)->orderBy('id', 'desc')->take(3)->where('status','Active')->get();
		// return view('frontEnd.shops.shop',compact('shop','count','products'));
		return view('newFrontend.pages.shop',compact('shop','count','products'));
	}

	public function productView($slug, Request $request){

		$affiliator = DB::table('users')->where('id',$request->input('id'))->first();

		$product = Product::where('slug',$slug)
							->where('status','Active')
							->orWhere('status','Renewal')
							->first();
		if (count($product) == 0) {
			return redirect('/');
		}


	if($request->input('id') != null){


		if($row = DB::table('affiliators')->where('product_id',$product->id)->where('user_id',$request->input('id'))->first()){

			$visits = $row->visits + 1;
			DB::table('affiliators')->where('product_id',$product->id)->where('user_id',$request->input('id'))->update([
				'visits' => $visits
			]);
		}else{
			DB::table('affiliators')->insert([
					'user_id' => $request->input('id'),
					'product_id' => $product->id,
					'visits' => 1
			]);
		}

		$url = $request->segment(2) . '?id='.$request->input('id');

		if(!auth()->check()){
			$request->session()->put('url',$url);
		}

	}

		$moreProducts = Product::where('shop_id',$product->shops->id)
								->orderBy('id', 'desc')
								->where('status','Active')
								->where('id','!=',$product->id)
								->take(3)
								->get();
		// return view('frontEnd.products.product',compact('product','moreProducts','affiliator'));
			return view('newFrontend.pages.product',compact('product','moreProducts','affiliator'));
	}

	public function shopAllProducts($slug){
		$shop = Shop::where('slug',$slug)
					->where('status','Active')
					->orWhere('status','Renewal')
					->first();
		if (count($shop) == 0) {
			return redirect('/');
		}
		$products = Product::where('shop_id',$shop->id)
							->where('status','Active')
							->paginate(10);
		$count['products'] = Product::where('shop_id',$shop->id)->where('status','Active')->count();
		$count['shops'] = Shop::where('user_id',$shop->user_id)->where('status','Active')->count();
		return view('frontEnd.shops.all_products',compact('products','shop','count'));
	}

	public function shopOwner($slug){
		$user = User::where('user_name',$slug)->where('status',1)->first();
		if (count($user) == 0) {
			return redirect('/');
		}
		$shops = Shop::where('user_id',$user->id)->orderBy('id', 'desc')->take(3)->where('status','Active')->get();
		$products = Product::where('user_id',$user->id)->orderBy('id', 'desc')->take(3)->where('status','Active')->get();
		$count['products'] = Product::where('user_id',$user->id)->where('status','Active')->count();
		$count['shops'] = Shop::where('user_id',$user->id)->where('status','Active')->count();
		// return view('frontEnd.shop_owners.owner',compact('products','shops','count','user'));
		return view('newFrontend.pages.shop_owner',compact('products','shops','count','user'));
	}

	public function shopOwnerAllShops($slug){
		$user = User::where('user_name',$slug)->where('status',1)->first();
		if (count($user) == 0) {
			return redirect('/');
		}
		$shops = Shop::where('user_id',$user->id)->where('status','Active')->get();
		$count['products'] = Product::where('user_id',$user->id)->where('status','Active')->count();
		$count['shops'] = Shop::where('user_id',$user->id)->where('status','Active')->count();
		return view('frontEnd.shop_owners.all-shops',compact('shops','count','user'));
	}

	public function shopOwnerAllProducts($slug){
		$user = User::where('user_name',$slug)->where('status',1)->first();
		if (count($user) == 0) {
			return redirect('/');
		}
		$products = Product::where('user_id',$user->id)->where('status','Active')->get();
		$count['products'] = Product::where('user_id',$user->id)->where('status','Active')->count();
		$count['shops'] = Shop::where('user_id',$user->id)->where('status','Active')->count();
		return view('frontEnd.shop_owners.all-products',compact('products','count','user'));
	}















	//////////////////////////////////////////////////////////////////
	///////////////// Search Filters /////////////////////////////////

	public function searchProduct(Request $request){
		$q = $request->all();
		/*echo "<pre>";
		print_r($q);die();*/
		$products = Product::where('status','Active');
	   // dd($q);
		if($request->input('ebazarr') || isset($q['ebazarr'])){
		    $q['ebazarr'] = 'yes';
		    $admin_users = DB::table('users')->where('permissions_id',1)->get()->pluck('id');
		    $products = Product::where('status','Active')->whereIn('user_id',$admin_users);
		}

		if(!empty($q['category']) && $q['category'] != 'All' ){
			$category = Categories::where('slug',$q['category'])->first();
			$sub_categories = SubCategories::where('parent_id',$category->id)->get();
			$products->where('category_id',$category->id);
		}

		if(!empty($q['sub_category']) && $q['sub_category'] != 'All' ){
			$sub_category = SubCategories::where('slug',$q['sub_category'])->first();
			$products->where('sub_category_id',$sub_category->id);
		}

		if(!empty($q['stock'])){
			$products->where('quantity','>',0);
		}

		if(!empty($q['min'])){
			$products->where('price','>=',$q['min']);
		}

		if(!empty($q['max'])){
			$products->where('price','<=',$q['max']);
		}

		if(!empty($q['product_type'])){
			$products->whereIn('product_type',$q['product_type']);
		}

    	if (!empty($q['keyword'])) {
    		$keyword = $q['keyword'];
    		$products->where(function($query) use ($keyword){
	        	$query->where('title', 'like', '%' . $keyword . '%')
				  ->orWhere('description', 'like', '%' . $keyword . '%');
	    	});
    	}

    	$products->orderby('created_at','dsc');

    	$count = $products->count();
    	// $products = $products->paginate(120);
    	// $products->appends($q);
    	$products = $products->paginate(12);
    	$product_types = ProductType::all();
    	$categories = Categories::all();

	//	return view('frontEnd.products.products_list',compact('products','product_types','count','keyword','categories','sub_categories','q'));
		return view('newFrontend.pages.products',compact('products','product_types','count','keyword','categories','sub_categories','q'));
	}


	public function searchShop(Request $request){
		$q = $request->all();

		$shops = Shop::where('status','Active');

		if (!empty($q['keyword'])) {
    		$shops->where('title', 'like', '%' . $q['keyword'] . '%');
    	}
    	if (!empty($q['country_id']) && $q['country_id'] != 'All') {
    		$shops->where('country_id',$q['country_id']);
    		$states = State::where('country_id',$q['country_id'])->get();
    	}
    	if (!empty($q['state_id']) && $q['state_id'] != 'All') {
    		$shops->where('state_id',$q['state_id']);
    	}

    	$shops = $shops->paginate(12);
        /*echo "<pre>";print_r($shops);die;*/
    	$countries = Country::all();
    	$shops->appends($q);

		// return view('frontEnd.shops.shops_list',compact('shops','countries','q','states'));
		return view('newFrontend.pages.shops',compact('shops','countries','q','states'));

	}

	//Contact Us Form
	public function helpSupport(){
		// return view('frontEnd.general.contact-faq');
		return view('newFrontend.pages.faqs');
	}


}
