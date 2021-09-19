<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\Request;
use Auth;
use App\Order;
use App\OrderProducts;
use App\User;

class ReviewController extends Controller
{
    public function clientReviewsPost(Request $request){
        $this->validate($request,[
            'rating' => 'required',
            'review' => 'required',
        ]);
        $orderProduct = OrderProducts::where('client_id',Auth::user()->id)
                                        ->where('id',$request->id)
                                        ->where('review',0)
                                        ->first();
        if(count($orderProduct)>0){
            if ($request->rating <= 5) {
                $review = new Review();
                $review->order_product_id = $orderProduct->id;
                $review->product_id = $orderProduct->products->id;
                $review->client_id = Auth::user()->id;
                $review->vendor_id = $orderProduct->products->user_id;
                $review->rating = $request->rating;
                $review->review = $request->review;
                $review->save();

                $orderProduct->review = 1;
                $orderProduct->save();
                return redirect()->back()->with('doneMessage','Review Posted!');
            }
            return redirect()->back()->with('errorMessage','Invalid Review!');
        }
        else
            return redirect()->back()->with('errorMessage','Order Not Found!');
    }
    public function clientReviewsAll(){
    }
    public function clientReviewsPending(){
        $orderProducts = OrderProducts::where('client_id',Auth::user()->id)
                                        ->where('status','Completed')
                                        ->where('review',0)
                                        ->get();
        return view('frontEnd.client.reviews.orders',compact('orderProducts'));
    }
}
