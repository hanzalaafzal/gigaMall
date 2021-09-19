<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Cart;
use App\Product;
use Carbon\Carbon;
use App\CartCoupon;
use App\Coupon;
use Auth;
use DB;

class CartController extends Controller
{
	public function create($product_slug, Request $request){

    	$product = Product::where('slug',$product_slug)
                            ->where('status','Active')
                            ->where('quantity','>',0)
                            ->first();
    	if (count($product) == 0) {
    		return redirect()->back()->with('errorMessage',"Sorry! This product is out of stock.");
    	}
    	else{
    		$check_cart = Cart::where('user_id',Auth::user()->id)->where('product_id',$product->id)->first();
    		if (count($check_cart) > 0) {
    			return redirect()->back()->with('errorMessage','This product is already in cart list.');
    		}
    		$cart = new Cart();
    		$cart->user_id = Auth::user()->id;
    		$cart->product_id = $product->id;
            $cart->quantity = 1;
            $cart->affiliator = $request->id ?? 0;
    		$cart->save();


    		return redirect()->back()->with('doneMessage','Added to Cart.');
    	}
    }

    public function update($id,$quantity){
        $cart = Cart::where('user_id',Auth::user()->id)->where('id',$id)->first();
        if (count($cart) > 0) {
            if($cart->products->quantity >= $quantity){
                $cart->quantity = $quantity;
                $cart->save();
                $data['product'] = $cart->products;
                $data['status'] = 1;
                return response()->json($data);
            }
            else{
                $data['product'] = $cart->products;
                $data['status'] = 0;
                return response()->json($data);
            }
        }
        else
            return 'error';
    }

    public function myCart(){
        $carts = Cart::where('user_id',Auth::user()->id)->get();
        // return view('frontEnd.orders.cart',compact('carts'));
				return view('newFrontend.pages.cart',compact('carts'));
		}

    public function destroy($id){
        $cart = Cart::where('user_id',Auth::user()->id)->where('id',$id)->first();
        if (count($cart) > 0) {
            $cart->delete();
            return redirect()->back()->with('doneMessage','Product removed from cart.');
        }
        else
            return redirect()->back()->with('errorMessage','Product not found in cart.');
    }


    ///////////////////////////////////////////////////////
    //////////////////////Checkout////////////////////////

    public function checkout(){

        $expDateChk = Carbon::now()->toDateString();
        if(count(Auth::user()->addressBooksDefault) > 0){
            $CouponRedeemed=CartCoupon::where('user_id',Auth::user()->id)->first();
            $checkCoupon=Coupon::where('id',$CouponRedeemed['coupon_id'])->where('expiry_date','>=',$expDateChk)->where('coupon_status','Active')->first();

            if(count($checkCoupon)>0)
            {
                //echo "redeemed ok";die();
        //    return view('frontEnd.orders.checkout',['CouponAvailed'=>$checkCoupon]);
						return view('newFrontend.pages.checkout',['CouponAvailed'=>$checkCoupon]);
            }else{
                $CouponRedeemed=CartCoupon::where('user_id',Auth::user()->id)->first();
                if(count($CouponRedeemed)>0){
                    $CouponRedeemed->delete();
                }
                return view('frontEnd.orders.checkout');
                echo "no redeemed";die();
                 }
        }
        else{

            return redirect()->route('dashboard')->with('errorMessage','Add shipping address before checkout.');
        }
    }
}
