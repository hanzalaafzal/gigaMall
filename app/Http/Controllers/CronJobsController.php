<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop;
use App\wallet;
use App\Product;
use App\ProductGallery;
use App\ProductItems;
use Carbon;

class CronJobsController extends Controller
{
    public function addBonus(Request $request){
        $wallet = wallet::where('user_id',$request->user_id)->first();
        $wallet->referral_bonus = $wallet->referral_bonus + $request->bonus;
        $wallet->save();
        
        $shop = Shop::find($request->shop_id);
        $shop->ref_code = $request->ref_code;
        $shop->save();

        return response()->json('Done');
    }

    public function cronShopRefCode(){
        $shops = Shop::where('ref_code',null)->get();
        $url = url('/loyal/public/api/registration');
        foreach($shops as $shop){

            ?>
                <!DOCTYPE html>
                <html>
                    <head>
                        <title></title>
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <meta charset="utf-8"/>
                        <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
                    </head>
                    <body>
                        <img id="pre-loader" style="display: none" src="http://bazaarsy.com/frontEnd/images/pre-loader.gif">
                        <script type="text/javascript">
                            $.ajaxSetup({
                                headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                    }
                            });
                        </script>
                        <script type="text/javascript">
                            $( document ).ready(function(){
                                $.ajax({
                                    beforeSend: function(){
                                     $('#pre-loader').css('display','unset');
                                   },
                                   complete: function(){
                                     $('#pre-loader').css('display','none');
                                   },
                                    type:"get",
                                    url: '<?php echo $url; ?>',
                                    data:{
                                        'referral_code':'<?php echo $shop->referral_code; ?>',
                                        'first_name':'<?php echo $shop->users->first_name; ?>',
                                        'last_name':'<?php echo $shop->users->last_name; ?>',
                                        'email':'<?php echo $shop->slug; ?>',
                                        'package_id':'<?php echo $shop->package_id; ?>',
                                        'password':'<?php echo $shop->password; ?>',
                                        'security_code': 'S3X@#54sd2@ds',
                                    },
                                     callback: 'callback',
                                    dataType: "JSONP",
                                    success: function(data){
                                        $.ajax({
                                            type:"get",
                                            url: 'https://bazaarsy.com/cron/add-bonus/',
                                            data:{
                                                'user_id':'<?php echo $shop->users->id; ?>',
                                                'bonus': data['bonus'],
                                                'shop_id': '<?php echo  $shop->id ?>',
                                                'ref_code': data['ref_code'],
                                                '_token':'<?php echo csrf_token(); ?>'
                                            },
                                            dataType: "json",
                                            success: function(data1){
                                            }
                                        });
                                    },
                                    error: function(data){
                                        console.log(data);
                                    }
                                });
                            });

                        </script>

                    </body>
                </html>


                
                <script>
                    $(document).ajaxComplete(function() {
                      alert("A referral code has completed successfully");
                    });
                </script>
            <?php 
        }
        echo "<h3><a href='".url()->previous()."'>Return Back</a></h3>";die;
    }

    //Delete Shops
    public function deleteShops(){
    	$date = Carbon\Carbon::now();
    	$date->subMonth();
    	$shops = Shop::where('status','Deleted')->where('updated_at','<=',$date)->get();
    	if(count($shops)>0){
    		foreach ($shops as $shop) {
	    		$products = Product::where('shop_id',$shop->id)->get();
	    		if(count($products)>0){
	    			foreach ($products as $product) {
		    			$product_gal = ProductGallery::where('product_id',$product->id)->get();
		    			if(count($product_gal)>0){
		    				foreach ($product_gal as $p_gal) {
								unlink(base_path().'/public/frontEnd/images/products/gallery/'.$p_gal->photo);
								$p_gal->delete();
			    			}
		    			}
		    			$product_itms = ProductItems::where('product_id',$product->id)->delete();
		    			unlink(base_path().'/public/frontEnd/images/products/'.$product->photo);
		    			$product->delete();
		    		}
	    		}
	    		unlink(base_path().'/public/frontEnd/images/shops/'.$shop->photo);
	    		$shop->delete();
	    	}
    	}
        echo "Done";
    }


    // Delete Products
    public function deleteProducts(){
        $date = Carbon\Carbon::now();
        $date->subMonth();
        $products = Product::where('status','Deleted')->where('updated_at','<=',$date)->get();
        if(count($products)>0){
            foreach ($products as $product) {
                $product_gal = ProductGallery::where('product_id',$product->id)->get();
                if(count($product_gal)>0){
                    foreach ($product_gal as $p_gal) {
                        unlink(base_path().'/public/frontEnd/images/products/gallery/'.$p_gal->photo);
                        $p_gal->delete();
                    }
                }
                $product_itms = ProductItems::where('product_id',$product->id)->delete();
                unlink(base_path().'/public/frontEnd/images/products/'.$product->photo);
                $product->delete();
            }
        }

        echo "Done";
    }

    public function shopsRenewal(){
        $date = Carbon\Carbon::now();
        $shops = Shop::where('status','Active')->where('end_date','<=',$date)->get();

        foreach ($shops as $shop) {
            $products = Product::where('shop_id',$shop->id)->where('status','Active')->get();
            if (count($products)>0) {
                foreach ($products as $product) {
                    $product->status = 'Renewal';
                    $product->save();
                }
            }
            $shop->status = 'Renewal';
            $shop->save();
        }
        echo "Done";
    }



}
