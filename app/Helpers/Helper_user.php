<?php

// This class file to define all general functions

namespace App\Helpers;

use App\AnalyticsPage;
use App\AnalyticsVisitor;
use App\Country;
use App\Event;
use App\Section;
use App\Setting;
use App\Topic;
use App\Webmail;
use App\WebmasterSection;
use App\WebmasterSetting;
use Auth;
use App\Favourite;
use App\Cart;
use App\Product;
use App\Categories;
use App\Shop;
use App\User;

class Helper_user
{
	static function carts(){
		$carts = Cart::where('user_id',Auth::user()->id)->get();
		return $carts;
	}
    static function check_fav($id){
        if (Auth::check()) {
            $fav = Favourite::where('user_id',Auth::user()->id)->where('product_id',$id)->get();
            if (count($fav) > 0) {
                $data['fav'] = $fav;
                $data['status'] = 1;
                return $data;
            }
            else
                return 0;
        }
        else
            return 0;
    }
    static function check_cart($id){
        if (Auth::check()) {
            $cart = Cart::where('user_id',Auth::user()->id)->where('product_id',$id)->get();
            if (count($cart) > 0) {
                return 1;
            }
            else
                return 0;
        }
        else
            return 0;
    }

    static function rating($id){
        $product = Product::find($id);
        if (count($product->reviews)>0) {
            $sum = 0;
            foreach ($product->reviews as $review) {
                $sum = $sum + $review->rating;
            }
            $rating = number_format($sum/count($product->reviews), 1); 
            return $rating;
        }
        else{
            $rating = 'NA';
            return $rating;
        }
    }

    static function getCategories(){
        $categories = Categories::where('status','Active')->get();
        return $categories;
    }

    //Shops Rating
    static function shop_rating($id){
        $shop = Shop::find($id);
        $sum = 0;
        $count = 0;
        foreach ($shop->products as $product) {
            $product_rating =  Helper_user::rating($product->id);
            if ($product_rating != 'NA') {
                $sum = $sum + $product_rating;
                $count++;
            }
        }
        if ($count == 0) {
            return 'NA';
        }
        else{
            $shop_rating = number_format($sum/$count, 1);
            return $shop_rating;
        }
    }

    //Vendor Rating
    static function vendor_rating($id){
        $user = User::find($id);
        $sum = 0;
        $count = 0;
        foreach ($user->shops as $shop) {
            $shop_rating =  Helper_user::shop_rating($shop->id);
            if ($shop_rating != 'NA') {
                $sum = $sum + $shop_rating;
                $count++;
            }
        }
        if ($count == 0) {
            return 'NA';
        }
        else{
            $user_rating = number_format($sum/$count, 1);
            return $user_rating;
        }
    }

    static function usd_to_pkr($amount){
        $from   = 'USD'; //US Dollar
        $to     = 'PKR'; //to Philippine Peso
         
        $url = 'http://finance.yahoo.com/d/quotes.csv?e=.csv&f=sl1d1t1&s='. $from . $to .'=X';
        $handle = @fopen($url, 'r');
        if ($handle) {
            $result = fgets($handle, 4096);
            fclose($handle);
        }
         
        $array = explode(',',$result);
    }

}


?>