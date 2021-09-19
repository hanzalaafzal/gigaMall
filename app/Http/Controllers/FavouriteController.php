<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Favourite;
use App\Product;
use Auth;

class FavouriteController extends Controller
{
    public function create($product_slug){
    	$product = Product::where('slug',$product_slug)->where('status','Active')->first();
    	if (count($product) == 0) {
    		return redirect()->back()->with('errorMessage','This product can not be favourite.');
    	}
    	else{
    		$fav_check = Favourite::where('user_id',Auth::user()->id)->where('product_id',$product->id)->first();
    		if (count($fav_check) > 0) {
    			return redirect()->back()->with('errorMessage','This product is already in favourite list.');
    		}
    		$favourite = new Favourite();
    		$favourite->user_id = Auth::user()->id;
    		$favourite->product_id = $product->id;
    		$favourite->save();
    		return redirect()->back()->with('doneMessage','Added To Favourites!');
    	}
    }
    public function destroy($id){
        $fav = Favourite::where('user_id',Auth::user()->id)->where('id',$id)->first();
        if (count($fav) > 0) {
            $fav->delete();
            return redirect()->back()->with('doneMessage','Product Removed From Favourite List.');
        }
        else
            return redirect()->back()->with('errorMessage','Product Not Found in Favourite List.');
    }

    public function myFavourites(){
        $favourites = Favourite::where('user_id',Auth::user()->id)->paginate(12);
        return view('frontEnd.client.favourites.my_favourites',compact('favourites'));
    }


}
