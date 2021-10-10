<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderAddress;
use App\OrderProducts;
use App\Product;
use App\Cart;
use App\AddressBook;
use Auth;
use App\WalletTransaction;
use App\Shop;
use App\Categories;
use App\ProductType;
use App\ProductGallery;
use Carbon\Carbon;
use App\Coupon;
use App\Wallet;
use App\CartCoupon;
use DB;
use App\WebmasterSection;

class OrderController extends Controller
{
    public function create_slug($slug)
    {
        $slug = strtolower($slug);
        $slug = preg_replace("/[^A-Za-z0-9\-]/", ' ', $slug);
        $slug = preg_replace('/\s+/', '-', $slug);
        $count = 0;
        for ($i = 0; $count == 0; $i++) {
            $check_slug = Product::where('slug', $slug)->get();
            if (count($check_slug) > 0) {
                $slug .= '-' . rand(0, 99);
            } else
                $count = 1;
        }
        return $slug;
    }


     public function productCreate()
    {
        $shops = Shop::where('user_id', Auth::user()->id)->where('status', 'Active')->get();
        $categories = Categories::all();
        $product_types = ProductType::all();

            return view('frontEnd.vendor.products.create', compact('categories', 'shops', 'product_types'));
    }

     public function storeProduct(Request $request)
    {

        $this->validate($request, [
            'title' => 'required|max:190',
            'description' => 'required',
            'original_price' => 'required',
            'price' => 'required',
            'shipping_price' => 'required',
            'quantity' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'photo' => 'required',
            'product_type' => 'required',
        ]);

        // if($request->original_price < $request->price){
        //      return redirect()->back()->with('errorMessage', 'Something Went Wrong');
        // }




        $slug = $this->create_slug($request->title);

        $product = new Product();
        $product->user_id = Auth::user()->id;
        $product->shop_id = $shop->id;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->original_price = $request->original_price;
        $product->price = $request->price;
        $product->shipping_price = $request->shipping_price;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->daily_sale = $request->has('daily_sale')?1:0;
        $product->slug = $slug;
        $product->product_type = $request->product_type;
        $product->status = 'Pending';

        if (!empty(request()->file('photo'))) {
            $destinationPath = base_path() . '/public/frontEnd/images/products';
            $extension = request()->file('photo')->getClientOriginalExtension();
            $fileName = 'product-photo-' . time() . rand() . $product->id . '.' . $extension;
            request()->file('photo')->move($destinationPath, $fileName);

            $product->photo = $fileName;
        }
        $product->save();

        if (count(request()->file('gallery_photos')) > 0) {
            foreach (request()->file('gallery_photos') as $mul_image) {
                $destinationPath = base_path() . '/public/frontEnd/images/products/gallery';
                $extension = $mul_image->getClientOriginalExtension();
                $fileName = 'gallery-photo-' . time() . rand() . $product->id . '.' . $extension;
                $mul_image->move($destinationPath, $fileName);

                $gallery = new ProductGallery;
                $gallery->product_id = $product->id;
                $gallery->photo = $fileName;
                $gallery->save();
            }
        }
        return redirect('admin/products/all')->with('doneMessage', 'Product Added Successfully');
    }


    public function adminOrders(){
       $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $orders = Order::orderBy('updated_at', 'acs')->paginate(10);

        $count['All'] = Order::count();
        $count['Active'] = Order::where('status', 'Active')->count();
        $count['Completed'] = Order::where('status', 'Completed')->count();

        return view('backEnd.details.orders', compact('orders', 'GeneralWebmasterSections', 'count'));
    }

    public function adminOrderSingle($orderid){
      $order= DB::table('orders')->where('order_number','=',$orderid)
              ->get();
      $order_address=DB::table('order_addresses')->where('order_id','=',$order[0]->id)->get();

      $order_products=DB::table('order_products')->where('order_id',$order[0]->id)->join('products','order_products.product_id','=','products.id')->join('users','order_products.vendor_id','=','users.id')
      ->join('shops','users.id','=','shops.user_id')->select("*",'order_products.quantity AS qty')->get();



      return view('backEnd.details.single_order',compact('order','order_address','order_products'));

    }

    public function create_order_number()
    {
        $count = 0;
        $order_number = rand(00000000, 99999999);
        for ($i = 0; $count == 0; $i++) {
            $check = Order::where('order_number', $order_number)->get();
            if (count($check) > 0) {
                $order_number = rand(00000000, 99999999);
            } else
                $count = 1;
        }
        return $order_number;
    }

    public function withdraw_amount(){
            if(auth()->user()->permissions_id == 5){
                $latest = DB::table('affiliator_orders')->where('user_id',auth()->user()->id)->orderBy('id','desc')->get();
                $nowTime=Carbon::now();

                $nowTime=$nowTime->subMinutes(1);
                $releaseAmount=0;
                foreach($latest as $lat){
                  if($lat->created_at > $nowTime){

                  }else{
                    $releaseAmount=$releaseAmount+$lat->profit;
                  }
                }

                $withdrawRequestsAmount=DB::table('withdraw_requests')->where('user_id',auth()->user()->id)->where('status',0)->sum('amount');

                $releaseAmount=$releaseAmount-$withdrawRequestsAmount;
                //pluck('created_at')->first();
                // $date = Carbon::now();
                // $date->subMinutes(1);
                // // dd($latest,$date);
                // if($latest > $date){
                //     return redirect()->back()->with('message','Wait for seven days before withdraw');
                // }
            }

        // return view('frontEnd.client.withdraw_amount',compact('releaseAmount'));
        return view('newFrontend.pages.withdraw',compact('releaseAmount'));
    }

    public function post_withdraw_amount(Request $request){

        //$amount = DB::table('wallets')->where('user_id',auth()->user()->id)->pluck('amount')->first();

        $latest = DB::table('affiliator_orders')->where('user_id',auth()->user()->id)->orderBy('id','desc')->get();
        $nowTime=Carbon::now();

        $nowTime=$nowTime->subMinutes(1);
        $releaseAmount=0;
        foreach($latest as $lat){
          if($lat->created_at > $nowTime){

          }else{
            $releaseAmount=$releaseAmount+$lat->profit;
          }
        }

        $withdrawRequestsAmount=DB::table('withdraw_requests')->where('user_id',auth()->user()->id)->where('status',0)->sum('amount');
        $releaseAmount=$releaseAmount-$withdrawRequestsAmount;

        if($releaseAmount > 0){
          if($request->amount <= 0 ){
            return redirect()->back()->with('message','Amount cannot be zero');
          }elseif($request->amount > $releaseAmount){
            return redirect()->back()->with('message','Provided amount is greater than release amount');
          }
        }else{
          return redirect()->back()->with('message','You donot have enough releaseable amount');
        }


        DB::table('withdraw_requests')->insert([
            'method' => $request->method??'None',
            'name' => $request->name??'',
            'card_number' => $request->card_number??'',
            'phone_number' => $request->phone_number??'',
            'bank' => $request->bank??'',
            'user_id' => auth()->user()->id,
            'amount' => $request->amount,
        ]);

        $walletAmount=DB::table('wallets')->where('user_id',auth()->user()->id)->pluck('amount')->first();

        $walletAmount=$walletAmount-$request->amount;

        DB::table('wallets')->where('user_id',auth()->user()->id)->update([
            'amount' => $walletAmount
        ]);

        return redirect('dashboard')->with('message','Withdraw request send');
    }

    public function recharge_e_wallet(){
        // return view('frontEnd.client.recharge_e_wallet');
          return view('newFrontend.pages.recharge_wallet');
    }
    public function post_recharge_e_wallet(Request $request){
         \Stripe\Stripe::setApiKey ( 'sk_test_51H2omrEBrijIcOQ0FrcrRTJ0oFUOuaBvrr8r54VHpukmRzwHQ8HVDxGgMzp2ktmGY9SPzT9Bf0mp4SkuHCW1o9ZP00DHfHaVxj' );

            $amount = $request->amount * 100;
            try {
                \Stripe\Charge::create ( array (
                        "amount" => $amount,
                        "currency" => "PKR",
                        "source" => $request->input( 'stripeToken' ), // obtained with Stripe.js
                        "description" => "Test payment."
                ) );

             $prev_amount = DB::table('wallets')->where('user_id',auth()->user()->id)->pluck('amount')->first();
             $prev_amount = $prev_amount + $request->amount;
             DB::table('wallets')->where('user_id',auth()->user()->id)->update([
                'amount' => $prev_amount
             ]);
                return redirect('dashboard')->with('doneMessage','Successfully Recharged');

            } catch ( \Exception $e ) {
                // Session::flash ( 'message', "Error! Please Try again." );

                return redirect()->back();
            }

    }

    public function cash_on_delivery($subtotal, $shipping){

        $carts = Cart::where('user_id', Auth::user()->id)->get();

        // Calculate Prices
        $products_price = 0;
        $shipping_price = 0;
        $grand_price = 0;
        foreach ($carts as $cart) {

            $temp_prod = DB::table('products')->where('id',$cart->products->id)->first();
            $temp_category_percent = DB::table('categories',$temp_prod->category_id)->pluck('profit_percentage')->first();


            $p_price = $cart->products->price * $cart->quantity;
            $products_price = $products_price + $p_price;
            $shipping_price = $shipping_price + $cart->products->shipping_price;


            $checker = DB::table('affiliators')->where('user_id',$cart['affiliator'])->where('product_id',$cart->products->id)->first();

            if($checker){

                $purchases = $checker->purchases + 1;
                $p_price = $p_price * $temp_category_percent / 100;
                $profit = $checker->profit + $p_price;
                $temp_order_number = DB::table('orders')->orderBy('id','desc')->pluck('id')->first() + 1;
                //dd($profit);
                DB::table('affiliators')->where('user_id',$cart['affiliator'])->where('product_id',$cart->products->id)->update([
                    'purchases' => $purchases,
                    'profit' => $profit
                ]);

                DB::table('affiliator_orders')->insert([
                    'order_id' => $temp_order_number,
                    'product_id' => $cart->products->id,
                    'user_id' => $cart['affiliator'],
                    'profit' => $p_price
                ]);

                $pp = DB::table('wallets')->where('user_id',$checker->user_id)->pluck('amount')->first();
                DB::table('wallets')->where('user_id',$checker->user_id)->update([
                        'amount' => $pp + $p_price,
                    ]);

            }

        }
        $expDateChk = Carbon::now()->toDateString();
        $checkCoupon = CartCoupon::where('user_id', Auth::user()->id)->first();
        $OrignalCoupon = Coupon::where('id', $checkCoupon['coupon_id'])->where('expiry_date', '>=', $expDateChk)->where('coupon_status', 'Active')->first();
        if (isset($OrignalCoupon->discount_amount)) {
            $discountOfOrder = $OrignalCoupon->discount_amount;
            $delCouponAfterRedeem = CartCoupon::where('user_id', Auth::user()->id)->first();
            $delCouponAfterRedeem->delete();
        }
        if (isset($OrignalCoupon->discount_percentage)) {
            $discountOfOrder = ($products_price * ($OrignalCoupon->discount_percentage) / 100);
            $delCouponAfterRedeem = CartCoupon::where('user_id', Auth::user()->id)->first();
            $delCouponAfterRedeem->delete();
        }
        $grand_price = $shipping_price + $products_price;

        // Check User Wallet Money
        // if ($grand_price > Auth::user()->wallets->amount) {
        //     return redirect()->back()->with('errorMessage', 'You do not have much money to place order.');
        // }

        //Order Table

        $order_number = $this->create_order_number();

        $order = new Order();
        $order->client_id = Auth::user()->id;
        $order->order_number = $order_number;
        $order->products_price = $products_price;
        $order->shipping_price = $shipping_price;
        $order->grand_price = $grand_price;
        $order->payment_method = 'COD';
        $order->status = 'Active';
        if (isset($discountOfOrder)) {
            $order->discount = $discountOfOrder;
        }
        $order->save();

        $request->shipping_address = 'test';
        $request->billing_address = 'test';

        //Order Addresses
        $ship_add = AddressBook::find($request->shipping_address);
        $bill_add = AddressBook::find($request->billing_address);

        // Billing Address
        $bill_address = new OrderAddress();
        $bill_address->order_id = $order->id;
        $bill_address->full_name = $bill_add->full_name;
        $bill_address->phone = $bill_add->phone;
        $bill_address->country = $bill_add->countries->title_en;
        $bill_address->address = $bill_add->address;
        $bill_address->zip_code = $bill_add->zip_code;
        $bill_address->type = 'Billing';
        $bill_address->save();

        // Shipping Address
        if (!empty($request->same_add)) {
            $bill_address = new OrderAddress();
            $bill_address->order_id = $order->id;
            $bill_address->full_name = $bill_add->full_name;
            $bill_address->phone = $bill_add->phone;
            $bill_address->country = $bill_add->countries->title_en;
            $bill_address->address = $bill_add->address;
            $bill_address->zip_code = $bill_add->zip_code;
            $bill_address->type = 'Shipping';
            $bill_address->save();
        } else {
            $ship_address = new OrderAddress();
            $ship_address->order_id = $order->id;
            $ship_address->full_name = $ship_add->full_name;
            $ship_address->phone = $ship_add->phone;
            $ship_address->country = $ship_add->countries->title_en;
            $ship_address->address = $ship_add->address;
            $ship_address->zip_code = $ship_add->zip_code;
            $ship_address->type = 'Shipping';
            $ship_address->save();
        }


        //Order Products Items
        foreach ($carts as $cart) {
            $product = Product::find($cart->product_id);
            $product->quantity = $product->quantity - $cart->quantity;
            $product->save();

            $order_product = new OrderProducts();
            $order_product->client_id = Auth::user()->id;
            $order_product->vendor_id = $cart->products->user_id;
            $order_product->order_id = $order->id;
            $order_product->product_id = $cart->product_id;
            $order_product->product_price = $cart->products->price;
            $order_product->quantity = $cart->quantity;
            $order_product->shipping_price = $cart->products->shipping_price;
            $order_product->review = 0;
            $order_product->status = 'Pending';
            $order_product->save();
        }

        //Delete Cart
        $carts = Cart::where('user_id', Auth::user()->id)->delete();

        //Deduct from wallet
        // $walletTransactioned=0;
        // $wallet = Wallet::where('user_id', Auth::user()->id)->first();
        // if (isset($discountOfOrder)) {
        //     $wallet->amount = $wallet->amount - $grand_price + $discountOfOrder;
        //     $walletTransactioned= $grand_price + $discountOfOrder;
        // } else {
        //     $wallet->amount = $wallet->amount - $grand_price;
        //     $walletTransactioned=$grand_price;
        // }
        // $wallet->save();
        $today = Carbon::now()->toDateString();

      // $insertWalletTransaction=WalletTransaction::create(['transaction_type'=>'addition','transaction_amount'=> $walletTransactioned,'transaction_date'=>$today,'transaction_head'=>'purchased Product','user_id'=>Auth::user()->id]);
        return redirect()->route('clientOrdersActive')->with('doneMessage', 'Order Placed!');
    }

    public function storeBank($subtotal, $shipping){
        $subtotal = $subtotal;
        $shipping = $shipping;
        return view('frontEnd.orders.bank_payment',compact('subtotal','shipping'));
    }

    public function paymentPost(Request $request){
         \Stripe\Stripe::setApiKey ( 'sk_test_51H2omrEBrijIcOQ0FrcrRTJ0oFUOuaBvrr8r54VHpukmRzwHQ8HVDxGgMzp2ktmGY9SPzT9Bf0mp4SkuHCW1o9ZP00DHfHaVxj' );

           $amount = $request->amount * 100;
            try {
                \Stripe\Charge::create ( array (
                        "amount" => $amount,
                        "currency" => "PKR",
                        "source" => $request->input( 'stripeToken' ), // obtained with Stripe.js
                        "description" => "Test payment."
                ) );
                // Session::flash ( 'message', 'Payment done successfully !' );

        //         $this->validate($request, [
        //     'billing_address' => 'required',
        //     'shipping_address' => 'required',
        // ]);




            } catch ( \Exception $e ) {
                // Session::flash ( 'message', "Error! Please Try again." );

                 return redirect()->back();
            }

        $carts = Cart::where('user_id', Auth::user()->id)->get();

        // Calculate Prices
        $products_price = 0;
        $shipping_price = 0;
        $grand_price = 0;
        foreach ($carts as $cart) {

            $temp_prod = DB::table('products')->where('id',$cart->products->id)->first();
            $temp_category_percent = DB::table('categories',$temp_prod->category_id)->pluck('profit_percentage')->first();


            $p_price = $cart->products->price * $cart->quantity;
            $products_price = $products_price + $p_price;
            $shipping_price = $shipping_price + $cart->products->shipping_price;


            $checker = DB::table('affiliators')->where('user_id',$cart['affiliator'])->where('product_id',$cart->products->id)->first();

            if($checker){

                $purchases = $checker->purchases + 1;
                $p_price = $p_price * $temp_category_percent / 100;
                $profit = $checker->profit + $p_price;
                $temp_order_number = DB::table('orders')->orderBy('id','desc')->pluck('id')->first() + 1;
                //dd($profit);
                DB::table('affiliators')->where('user_id',$cart['affiliator'])->where('product_id',$cart->products->id)->update([
                    'purchases' => $purchases,
                    'profit' => $profit
                ]);

                DB::table('affiliator_orders')->insert([
                    'order_id' => $temp_order_number,
                    'product_id' => $cart->products->id,
                    'user_id' => $cart['affiliator'],
                    'profit' => $p_price
                ]);

                 $pp = DB::table('wallets')->where('user_id',$checker->user_id)->pluck('amount')->first();
                DB::table('wallets')->where('user_id',$checker->user_id)->update([
                        'amount' => $pp + $p_price,
                    ]);


            }

        }
        $expDateChk = Carbon::now()->toDateString();
        $checkCoupon = CartCoupon::where('user_id', Auth::user()->id)->first();
        $OrignalCoupon = Coupon::where('id', $checkCoupon['coupon_id'])->where('expiry_date', '>=', $expDateChk)->where('coupon_status', 'Active')->first();
        if (isset($OrignalCoupon->discount_amount)) {
            $discountOfOrder = $OrignalCoupon->discount_amount;
            $delCouponAfterRedeem = CartCoupon::where('user_id', Auth::user()->id)->first();
            $delCouponAfterRedeem->delete();
        }
        if (isset($OrignalCoupon->discount_percentage)) {
            $discountOfOrder = ($products_price * ($OrignalCoupon->discount_percentage) / 100);
            $delCouponAfterRedeem = CartCoupon::where('user_id', Auth::user()->id)->first();
            $delCouponAfterRedeem->delete();
        }
        $grand_price = $shipping_price + $products_price;

        // Check User Wallet Money
        // if ($grand_price > Auth::user()->wallets->amount) {
        //     return redirect()->back()->with('errorMessage', 'You do not have much money to place order.');
        // }

        //Order Table

        $order_number = $this->create_order_number();

        $order = new Order();
        $order->client_id = Auth::user()->id;
        $order->order_number = $order_number;
        $order->products_price = $products_price;
        $order->shipping_price = $shipping_price;
        $order->grand_price = $grand_price;
        $order->payment_method = 'Bank Account';
        $order->status = 'Active';
        if (isset($discountOfOrder)) {
            $order->discount = $discountOfOrder;
        }
        $order->save();

        $request->shipping_address = 'test';
        $request->billing_address = 'test';

        //Order Addresses
        $ship_add = AddressBook::find($request->shipping_address);
        $bill_add = AddressBook::find($request->billing_address);

        // Billing Address
        $bill_address = new OrderAddress();
        $bill_address->order_id = $order->id;
        $bill_address->full_name = $bill_add->full_name;
        $bill_address->phone = $bill_add->phone;
        $bill_address->country = $bill_add->countries->title_en;
        $bill_address->address = $bill_add->address;
        $bill_address->zip_code = $bill_add->zip_code;
        $bill_address->type = 'Billing';
        $bill_address->save();

        // Shipping Address
        if (!empty($request->same_add)) {
            $bill_address = new OrderAddress();
            $bill_address->order_id = $order->id;
            $bill_address->full_name = $bill_add->full_name;
            $bill_address->phone = $bill_add->phone;
            $bill_address->country = $bill_add->countries->title_en;
            $bill_address->address = $bill_add->address;
            $bill_address->zip_code = $bill_add->zip_code;
            $bill_address->type = 'Shipping';
            $bill_address->save();
        } else {
            $ship_address = new OrderAddress();
            $ship_address->order_id = $order->id;
            $ship_address->full_name = $ship_add->full_name;
            $ship_address->phone = $ship_add->phone;
            $ship_address->country = $ship_add->countries->title_en;
            $ship_address->address = $ship_add->address;
            $ship_address->zip_code = $ship_add->zip_code;
            $ship_address->type = 'Shipping';
            $ship_address->save();
        }


        //Order Products Items
        foreach ($carts as $cart) {
            $product = Product::find($cart->product_id);
            $product->quantity = $product->quantity - $cart->quantity;
            $product->save();

            $order_product = new OrderProducts();
            $order_product->client_id = Auth::user()->id;
            $order_product->vendor_id = $cart->products->user_id;
            $order_product->order_id = $order->id;
            $order_product->product_id = $cart->product_id;
            $order_product->product_price = $cart->products->price;
            $order_product->quantity = $cart->quantity;
            $order_product->shipping_price = $cart->products->shipping_price;
            $order_product->review = 0;
            $order_product->status = 'Pending';
            $order_product->save();
        }

        //Delete Cart
        $carts = Cart::where('user_id', Auth::user()->id)->delete();

        //Deduct from wallet
        // $walletTransactioned=0;
        // $wallet = Wallet::where('user_id', Auth::user()->id)->first();
        // if (isset($discountOfOrder)) {
        //     $wallet->amount = $wallet->amount - $grand_price + $discountOfOrder;
        //     $walletTransactioned= $grand_price + $discountOfOrder;
        // } else {
        //     $wallet->amount = $wallet->amount - $grand_price;
        //     $walletTransactioned=$grand_price;
        // }
        // $wallet->save();
        // $today = Carbon::now()->toDateString();

      // $insertWalletTransaction=WalletTransaction::create(['transaction_type'=>'addition','transaction_amount'=> $walletTransactioned,'transaction_date'=>$today,'transaction_head'=>'purchased Product','user_id'=>Auth::user()->id]);
        return redirect()->route('clientOrdersActive')->with('doneMessage', 'Order Placed!');
    }

    public function store(Request $request)
    {
       // dd($request);
         //echo "order store";die();
        $this->validate($request, [
            'billing_address' => 'required',
            'shipping_address' => 'required',
        ]);

        $carts = Cart::where('user_id', Auth::user()->id)->get();

        // Calculate Prices
        $products_price = 0;
        $shipping_price = 0;
        $grand_price = 0;
        foreach ($carts as $cart) {

            $temp_prod = DB::table('products')->where('id',$cart->products->id)->first();
            $temp_category_percent = DB::table('categories',$temp_prod->category_id)->pluck('profit_percentage')->first();


            $p_price = $cart->products->price * $cart->quantity;
            $products_price = $products_price + $p_price;
            $shipping_price = $shipping_price + $cart->products->shipping_price;


            $checker = DB::table('affiliators')->where('user_id',$cart['affiliator'])->where('product_id',$cart->products->id)->first();

            if($checker){

                $purchases = $checker->purchases + 1;
                $p_price = $p_price * $temp_category_percent / 100;
                $profit = $checker->profit + $p_price;
                $temp_order_number = DB::table('orders')->orderBy('id','desc')->pluck('id')->first() + 1;
                //dd($profit);
                DB::table('affiliators')->where('user_id',$cart['affiliator'])->where('product_id',$cart->products->id)->update([
                    'purchases' => $purchases,
                    'profit' => $profit
                ]);

                DB::table('affiliator_orders')->insert([
                    'order_id' => $temp_order_number,
                    'product_id' => $cart->products->id,
                    'user_id' => $cart['affiliator'],
                    'profit' => $p_price
                ]);

                 $pp = DB::table('wallets')->where('user_id',$checker->user_id)->pluck('amount')->first();
                DB::table('wallets')->where('user_id',$checker->user_id)->update([
                        'amount' => $pp + $p_price,
                    ]);


            }

        }
        $expDateChk = Carbon::now()->toDateString();
        $checkCoupon = CartCoupon::where('user_id', Auth::user()->id)->first();
        $OrignalCoupon = Coupon::where('id', $checkCoupon['coupon_id'])->where('expiry_date', '>=', $expDateChk)->where('coupon_status', 'Active')->first();
        if (isset($OrignalCoupon->discount_amount)) {
            $discountOfOrder = $OrignalCoupon->discount_amount;
            $delCouponAfterRedeem = CartCoupon::where('user_id', Auth::user()->id)->first();
            $delCouponAfterRedeem->delete();
        }
        if (isset($OrignalCoupon->discount_percentage)) {
            $discountOfOrder = ($products_price * ($OrignalCoupon->discount_percentage) / 100);
            $delCouponAfterRedeem = CartCoupon::where('user_id', Auth::user()->id)->first();
            $delCouponAfterRedeem->delete();
        }
        $grand_price = $shipping_price + $products_price;

        // Check User Wallet Money
        if ($grand_price > Auth::user()->wallets->amount) {
            return redirect()->back()->with('errorMessage', 'You do not have much money to place order.');
        }

        //Order Table

        $order_number = $this->create_order_number();

        $order = new Order();
        $order->client_id = Auth::user()->id;
        $order->order_number = $order_number;
        $order->products_price = $products_price;
        $order->shipping_price = $shipping_price;
        $order->grand_price = $grand_price;
        $order->payment_method = 'E-Wallet';
        $order->status = 'Active';
        if (isset($discountOfOrder)) {
            $order->discount = $discountOfOrder;
        }
        $order->save();

        //Order Addresses
        $ship_add = AddressBook::find($request->shipping_address);
        $bill_add = AddressBook::find($request->billing_address);

        // Billing Address
        $bill_address = new OrderAddress();
        $bill_address->order_id = $order->id;
        $bill_address->full_name = $bill_add->full_name;
        $bill_address->phone = $bill_add->phone;
        $bill_address->country = $bill_add->countries->title_en;
        $bill_address->address = $bill_add->address;
        $bill_address->zip_code = $bill_add->zip_code;
        $bill_address->type = 'Billing';
        $bill_address->save();

        // Shipping Address
        if (!empty($request->same_add)) {
            $bill_address = new OrderAddress();
            $bill_address->order_id = $order->id;
            $bill_address->full_name = $bill_add->full_name;
            $bill_address->phone = $bill_add->phone;
            $bill_address->country = $bill_add->countries->title_en;
            $bill_address->address = $bill_add->address;
            $bill_address->zip_code = $bill_add->zip_code;
            $bill_address->type = 'Shipping';
            $bill_address->save();
        } else {
            $ship_address = new OrderAddress();
            $ship_address->order_id = $order->id;
            $ship_address->full_name = $ship_add->full_name;
            $ship_address->phone = $ship_add->phone;
            $ship_address->country = $ship_add->countries->title_en;
            $ship_address->address = $ship_add->address;
            $ship_address->zip_code = $ship_add->zip_code;
            $ship_address->type = 'Shipping';
            $ship_address->save();
        }


        //Order Products Items
        foreach ($carts as $cart) {
            $product = Product::find($cart->product_id);
            $product->quantity = $product->quantity - $cart->quantity;
            $product->save();

            $order_product = new OrderProducts();
            $order_product->client_id = Auth::user()->id;
            $order_product->vendor_id = $cart->products->user_id;
            $order_product->order_id = $order->id;
            $order_product->product_id = $cart->product_id;
            $order_product->product_price = $cart->products->price;
            $order_product->quantity = $cart->quantity;
            $order_product->shipping_price = $cart->products->shipping_price;
            $order_product->review = 0;
            $order_product->status = 'Pending';
            $order_product->save();
        }

        //Delete Cart
        $carts = Cart::where('user_id', Auth::user()->id)->delete();

        //Deduct from wallet
        $walletTransactioned=0;
        $wallet = Wallet::where('user_id', Auth::user()->id)->first();
        if (isset($discountOfOrder)) {
            $wallet->amount = $wallet->amount - $grand_price + $discountOfOrder;
            $walletTransactioned= $grand_price + $discountOfOrder;
        } else {
            $wallet->amount = $wallet->amount - $grand_price;
            $walletTransactioned=$grand_price;
        }
        $wallet->save();
        $today = Carbon::now()->toDateString();

      // $insertWalletTransaction=WalletTransaction::create(['transaction_type'=>'addition','transaction_amount'=> $walletTransactioned,'transaction_date'=>$today,'transaction_head'=>'purchased Product','user_id'=>Auth::user()->id]);
        return redirect()->route('clientOrdersActive')->with('doneMessage', 'Order Placed!');
    }



    ///////////////////////////////////////////////////////////////////////
    ////////////////////// Vendor Functions //////////////////////////////

    public function vendorOrdersAll()
    {
        $count['pending'] = OrderProducts::where('vendor_id', Auth::user()->id)
            ->where('status', 'Pending')
            ->count();
        $count['delivered'] = OrderProducts::where('vendor_id', Auth::user()->id)
            ->where('status', 'Delivered')
            ->count();
        $count['completed'] = OrderProducts::where('vendor_id', Auth::user()->id)
            ->where('status', 'Completed')
            ->count();
        $count['rejected'] = OrderProducts::where('vendor_id', Auth::user()->id)
            ->where('status', 'Rejected')
            ->count();
        $orders = OrderProducts::where('vendor_id', Auth::user()->id)
            ->paginate(10);

        return view('frontEnd.vendor.orders.orders', compact('orders', 'count'));
    }
    public function vendorOrdersPending()
    {
        $count['pending'] = OrderProducts::where('vendor_id', Auth::user()->id)
            ->where('status', 'Pending')
            ->count();
        $count['delivered'] = OrderProducts::where('vendor_id', Auth::user()->id)
            ->where('status', 'Delivered')
            ->count();
        $count['completed'] = OrderProducts::where('vendor_id', Auth::user()->id)
            ->where('status', 'Completed')
            ->count();
        $count['rejected'] = OrderProducts::where('vendor_id', Auth::user()->id)
            ->where('status', 'Rejected')
            ->count();
        $orders = OrderProducts::where('vendor_id', Auth::user()->id)
            ->where('status', 'Pending')
            ->paginate(10);

        return view('frontEnd.vendor.orders.orders', compact('orders', 'count'));
    }
    public function vendorOrdersDelivered()
    {
        $count['pending'] = OrderProducts::where('vendor_id', Auth::user()->id)
            ->where('status', 'Pending')
            ->count();
        $count['delivered'] = OrderProducts::where('vendor_id', Auth::user()->id)
            ->where('status', 'Delivered')
            ->count();
        $count['completed'] = OrderProducts::where('vendor_id', Auth::user()->id)
            ->where('status', 'Completed')
            ->count();
        $count['rejected'] = OrderProducts::where('vendor_id', Auth::user()->id)
            ->where('status', 'Rejected')
            ->count();
        $orders = OrderProducts::where('vendor_id', Auth::user()->id)
            ->where('status', 'Delivered')
            ->paginate(10);

        return view('frontEnd.vendor.orders.orders', compact('orders', 'count'));
    }
    public function vendorOrdersCompleted()
    {
        $count['pending'] = OrderProducts::where('vendor_id', Auth::user()->id)
            ->where('status', 'Pending')
            ->count();
        $count['delivered'] = OrderProducts::where('vendor_id', Auth::user()->id)
            ->where('status', 'Delivered')
            ->count();
        $count['completed'] = OrderProducts::where('vendor_id', Auth::user()->id)
            ->where('status', 'Completed')
            ->count();
        $count['rejected'] = OrderProducts::where('vendor_id', Auth::user()->id)
            ->where('status', 'Rejected')
            ->count();
        $orders = OrderProducts::where('vendor_id', Auth::user()->id)
            ->where('status', 'Completed')
            ->paginate(10);

        return view('frontEnd.vendor.orders.orders', compact('orders', 'count'));
    }
    public function vendorOrdersRejected()
    {
        $count['pending'] = OrderProducts::where('vendor_id', Auth::user()->id)
            ->where('status', 'Pending')
            ->count();
        $count['delivered'] = OrderProducts::where('vendor_id', Auth::user()->id)
            ->where('status', 'Delivered')
            ->count();
        $count['completed'] = OrderProducts::where('vendor_id', Auth::user()->id)
            ->where('status', 'Completed')
            ->count();
        $count['rejected'] = OrderProducts::where('vendor_id', Auth::user()->id)
            ->where('status', 'Rejected')
            ->count();
        $orders = OrderProducts::where('vendor_id', Auth::user()->id)
            ->where('status', 'Rejected')
            ->paginate(10);

        return view('frontEnd.vendor.orders.orders', compact('orders', 'count'));
    }
    public function vendorOrderView($id)
    {
        $order = OrderProducts::where('id', $id)->where('vendor_id', Auth::user()->id)->first();
        if (count($order) > 0) {
            return view('frontEnd.vendor.orders.order_view', compact('order'));
        } else
            return redirect()->back()->with('errorMessage', 'Order Not Found');
    }
    public function vendorOrderAccept(Request $request)
    {
        $order = OrderProducts::where('id', $request->id)->where('vendor_id', Auth::user()->id)->first();

        if (count($order) > 0) {
            $order->shipping_days = $request->days;
            $order->status = 'Active';
            $order->save();
            return redirect()->back()->with('doneMessage', 'Order Accepted!');
        }
        return redirect()->back()->with('errorMessage', 'Order Not Found');
    }

    public function vendorOrderReject($id)
    {
        $order = OrderProducts::where('id', $id)->where('vendor_id', Auth::user()->id)->first();

        if (count($order) > 0) {
            $order->status = 'Rejected';
            $order->save();
            return redirect()->back()->with('doneMessage', 'Order Rejected!');
        }
        return redirect()->back()->with('errorMessage', 'Product Not Found');
    }
    public function vendorOrderDeliver($id)
    {
        $order = OrderProducts::where('id', $id)->where('vendor_id', Auth::user()->id)->first();
        if (count($order) > 0) {
            $order->status = 'Delivered';
            $order->save();
            return redirect()->back()->with('doneMessage', 'Order Delivered!');
        }
        return redirect()->back()->with('errorMessage', 'Product Not Found');
    }
    public function vendorOrderShipped($id)
    {
        $order = OrderProducts::where('id', $id)->where('vendor_id', Auth::user()->id)->first();
        if (count($order) > 0) {
            $order->status = 'Shipped';
            $order->save();
            return redirect()->back()->with('doneMessage', 'Order Marked Shipped!');
        }
        return redirect()->back()->with('errorMessage', 'Product Not Found');
    }

    public function salesStatements()
    {
        $order['total-orders'] = OrderProducts::where('vendor_id', Auth::user()->id)->count();
        $order['total-price'] = OrderProducts::where('vendor_id', Auth::user()->id)->sum('product_price', 'shipping_price');
        if ($order['total-orders'] > 0) {
            $order['ave-price'] = $order['total-price'] / $order['total-orders'];
        } else
            $order['ave-price'] = 0;
        return view('frontEnd.vendor.sales-statements.sales', compact('order'));
    }







    //////////////////////////////////////////////////////////////////////
    //////////////////////////// Client Functions ////////////////////////

    public function clientOrdersAll()
    {
        $orders = Order::where('client_id', Auth::user()->id)->get();
        $count['active'] = Order::where('client_id', Auth::user()->id)->where('status', 'Active')->count();
        $count['completed'] = Order::where('client_id', Auth::user()->id)->where('status', 'Completed')->count();
        $count['all'] = Order::where('client_id', Auth::user()->id)->count();
        return view('frontEnd.client.orders.orders', compact('orders', 'count'));
    }
    public function clientOrdersActive()
    {
        $orders = Order::where('client_id', Auth::user()->id)->where('status', 'Active')->orderBy('id','desc')->get();
        $count['active'] = Order::where('client_id', Auth::user()->id)->where('status', 'Active')->count();
        $count['completed'] = Order::where('client_id', Auth::user()->id)->where('status', 'Completed')->count();
        $count['all'] = Order::where('client_id', Auth::user()->id)->count();
        return view('frontEnd.client.orders.orders', compact('orders', 'count'));
    }
    public function downloadInvoice($id){
        $order = Order::where('id', $id)->where('client_id', Auth::user()->id)->first();
        $pdf = \PDF::loadView('frontEnd.client.orders.invoice',compact('order'));
        return $pdf->download('invoice.pdf');
    }
    public function clientOrdersCompleted()
    {
        $orders = Order::where('client_id', Auth::user()->id)->where('status', 'Completed')->get();
        $count['active'] = Order::where('client_id', Auth::user()->id)->where('status', 'Active')->count();
        $count['completed'] = Order::where('client_id', Auth::user()->id)->where('status', 'Completed')->count();
        $count['all'] = Order::where('client_id', Auth::user()->id)->count();
        return view('frontEnd.client.orders.orders', compact('orders', 'count'));
    }

    public function clientOrderView($id)
    {
        $order = Order::where('id', $id)->where('client_id', Auth::user()->id)->first();
        if (count($order) > 0) {
            return view('frontEnd.client.orders.order_page', compact('order'));
        } else
            return rdirect()->back()->with('errorMessage', 'Order Not Found!');
    }

    public function purchaseStatements()
    {
        $order['total'] = Order::where('client_id', Auth::user()->id)->count();
        $order['spend'] = Order::where('client_id', Auth::user()->id)->sum('grand_price');
        if ($order['total'] > 0) {
            $order['ave-price'] = $order['spend'] / $order['total'];
        } else
            $order['ave-price'] = 0;
        return view('frontEnd.client.purchase-statements.purchases', compact('order'));
    }
    public function clientMarkDelivered($id)
    { //echo "mark complete id is";echo $id;die();
        $order = OrderProducts::where('id', $id)->where('client_id', Auth::user()->id)->first();

        if (count($order) > 0) {
            $order = OrderProducts::where('id', $id)->where('client_id', Auth::user()->id)->first();
            $order->status="Delivered";
            $order->save();
            return redirect()->back()->with('errorMessage', 'Order Marked Delivered');
            //return view('frontEnd.vendor.orders.order_view', compact('order'));
        } else
            return redirect()->back()->with('errorMessage', 'Order Not Found');
    }
}
