<?php

namespace App\Http\Controllers;
use App\WebmasterSection;
use App\ProductType;
use App\Coupon;
use App\Deal;
use App\Package;
use App\CartCoupon;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

class CouponsController extends Controller
{
    public function coupons()
    {
    $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $coupons = Coupon::all();
        $types = ProductType::all();
        return view('backEnd.coupons.coupons',compact('GeneralWebmasterSections','coupons','types'));

    }
    public function store(Request $request)
    {   $allData=$request->all();
        $alreadyExists=Coupon::where('coupon_code',$allData['coupon_code'])->first();
        if(count($alreadyExists)>0)
            {
                return redirect()->route('coupons')->with('errorMessage','Coupon can not be created as it already exists.');        
            }
       $creationDate = Carbon::now()->toDateString();
       $allData['creation_date']=$creationDate;
       $insertCoupon=Coupon::create($allData);
       return redirect()->route('coupons')->with('doneMessage','Coupon Created Successfully.');
        $this->validate($request, [
            'coupon_code' => 'required|max:255',
            'expiry_date' => 'required|unique:categories',
            'coupon_status' => 'required',
        ]);
        }

        public function disableCoupon($id)
        { 
$statCoupon=Coupon::find($id);
$statCoupon->coupon_status="Deactive";
$statCoupon->save();
return redirect()->route('coupons')->with('doneMessage','Coupon Disabled Successfully.');
            
        }
        public function activeCoupon($id)
        {
            $statCoupon=Coupon::find($id);
            $statCoupon->coupon_status="Active";
            $statCoupon->save();
            return redirect()->route('coupons')->with('doneMessage','Coupon Activated Successfully.');
        }
        public function editCoupon($id)
        { $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
            $coupon = Coupon::find($id);
           return view('backEnd.coupons.edit',compact('coupon','GeneralWebmasterSections'));
            echo "Edit  coupon";die();
        }
        public function deleteCoupon($id)
        {
            $statCoupon=Coupon::find($id);
            $statCoupon->delete();
            
            return redirect()->route('coupons')->with('doneMessage','Coupon Deleted Successfully.');
        }
        public function updateCoupon(Request $request)
        {   
            $input=$request->all();
            $alreadyExists=Coupon::where('coupon_code',$input['coupon_code'])
            ->whereNotIn('id',[$input['id']])
            ->first();
            if(count($alreadyExists)>0)
            {
                return redirect()->route('coupons')->with('errorMessage','Cannot edit Coupon as coupon with same code already exists .');
            }
            $editCoupon=Coupon::find($input['id']);
            $editCoupon->promo_name=$input['promo_name'];
            $editCoupon->coupon_code=$input['coupon_code'];
            $editCoupon->	expiry_date=$input['expiry_date'];
            $editCoupon->coupon_status=$input['coupon_status'];
            $editCoupon->discount_amount=$input['discount_amount'];
            $editCoupon->discount_percentage=$input['discount_percentage'];
            $editCoupon->save();
            return redirect()->route('coupons')->with('doneMessage','Coupon updated Successfully.');
           
           

        }
        /**Coupons Redeem section */
        public function couponsRedeem(Request $request)
        {   $today= Carbon::now()->toDateString();
            $input=$request->all();
            $couponRedeemCheck=CartCoupon::where('user_id',Auth::user()->id)->first();
            if(count($couponRedeemCheck)>0)
            {
                return redirect()->route('checkout')->with('errorMessage','You already availed one coupon.');
            }
            $couponExists=Coupon::where('coupon_code',$input['coupon_code'])->where('coupon_status','Active')->where('expiry_date','>=',$today)->first();
            if(count($couponExists)>0)
            {
                $insertRedeem=CartCoupon::create(['coupon_id'=>$couponExists->id,'user_id'=>Auth::user()->id]);
                return redirect()->route('checkout')->with('doneMessage','Coupon Applied Successfully.');
                
            }
            $couponStatus=Coupon::where('coupon_code',$input['coupon_code'])->where('coupon_status','!=','Active')->first();
            if(count($couponStatus)>0)
            { 
                return redirect()->route('checkout')->with('errorMessage','Coupon no longer exists.');

            }
            $couponCreated=Coupon::where('coupon_code',$input['coupon_code'])->first();
            if(count($couponCreated)>0)
            { 
               

            }else{
                return redirect()->route('checkout')->with('errorMessage','Coupon does not exists.');

            }
            $expiredCoupon=Coupon::where('coupon_code',$input['coupon_code'])->where('expiry_date','<',$today)->first();
            if(count($expiredCoupon)>0)
            { 
                return redirect()->route('checkout')->with('errorMessage','Coupon Expired.');

            }
           return redirect()->route('checkout')->with('errorMessage','Redircted to checkout.');
        }
         /**End Coupons Redeem section */
       /***Deals section */
       public function deals()
    {    
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $deals = Deal::all();
     
        $types = ProductType::all();
        return view('backEnd.deals.deals',compact('GeneralWebmasterSections','deals','types'));

    } 

    public function storeDeal(Request $request)
    {   $allData=$request->all();
        $creationDate = Carbon::now()->toDateString();
        $allData['creation_date']=$creationDate;
        $insertDeal=Deal::create($allData);
        return redirect()->route('deals')->with('doneMessage','Deal Created Successfully.');
     

     
        $this->validate($request, [
            'coupon_code' => 'required|max:255',
            'expiry_date' => 'required|unique:categories',
            'coupon_status' => 'required',
        ]);
        }

        public function disableDeal($id)
        {
            
            $statDeal=Deal::find($id);
            $statDeal->deal_status="Deactive";
$statDeal->save();
return redirect()->route('deals')->with('doneMessage','Deal Disabled Successfully.');

        }
        public function activeDeal($id)
        {
            $statDeal=Deal::find($id);
            $statDeal->deal_status="Active";
            $statDeal->save();
            return redirect()->route('deals')->with('doneMessage','Deal Activated Successfully.');
        }
        public function editDeal($id)
        {
            $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
            $deal = Deal::find($id);
           return view('backEnd.deals.edit',compact('deal','GeneralWebmasterSections'));
            echo "Edit  coupon";die();
        }
        public function deleteDeal($id)
        {
           $statDeal=Coupon::find($id);
            $statDeal->delete();
            
            return redirect()->route('deals')->with('doneMessage','Deal Deleted Successfully.');
        }  
        public function updateDeal(Request $request)
        {
          $input=$request->all();
          $editDeal=Deal::find($input['id']);
          $editDeal->deal_name=$input['deal_name'];
       // $editDeal->coupon_code=$input['coupon_code'];
          $editDeal->expiry_date=$input['expiry_date'];
          $editDeal->deal_status=$input['deal_status'];
          $editDeal->discount_amount=$input['discount_amount'];
          $editDeal->discount_percentage=$input['discount_percentage'];
          $editDeal->save();
          return redirect()->route('deals')->with('doneMessage','Updated Deal Successfully.');
          

        }  


}
