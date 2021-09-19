<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payments;
use App\Package;
use Auth;
use App\Withdrawal;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

class PaymentsController extends Controller
{

    public function buy()
    {
        $packages = Package::where('id','!=',0)->get();
        return view('frontEnd.vendor.packages.choose',compact('packages'));
    }

    public function choosePackage(Request $request){

        $package = Package::find($request->package_id);
        $payment  = new Payments();
        $payment->user_id = Auth::user()->id;
        $payment->package_id = $request->package_id;
        $payment->amount = $package->price;
        $payment->status = 'Available';
        $payment->save();

        return redirect()->route('shopCreate');
    }

    public function myPackages(){
        $payments = Payments::where('user_id',Auth::user()->id)
                            ->where('status','Available')
                            ->get();
        return view('frontEnd.vendor.packages.my-packages',compact('payments'));
    }
    public function withdrawal(){
        return view('frontEnd.vendor.payments.create');
    }

    public function withdrawalPost(Request $request){
        $this->validate($request, [
            'full_name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'bank_name' => 'required',
            'account_number' => 'required',
        ]);

        $withdrawal = new Withdrawal();
        $withdrawal->user_id = Auth::user()->id;
        $withdrawal->full_name = $request->full_name ;
        $withdrawal->email = $request->email ;
        $withdrawal->address = $request->address ;
        $withdrawal->bank_name = $request->bank_name ;
        $withdrawal->account_number = $request->account_number ;
        $withdrawal->save();

        return redirect('/dashboard')->with('doneMessage','Withdrawal Request Sent!');

    }
    
    
    // Authorize.net Payment
    public function authorizeNet(Request $request){
        $this->validate($request,[
            'credit_card_number' => 'required',
            'expiry_year' => 'required',
            'expiry_month' => 'required',
            'cvv' => 'required',
            'package_id' => 'required',
        ]);

        $package = Package::find($request->package_id);

    	// Common setup for API credentials  
	  $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();   
	  $merchantAuthentication->setName("2Z7sAHf2Q");   
	  $merchantAuthentication->setTransactionKey("86GzA45dz8d5JE58");   
	  $refId = 'ref' . time();

	  // Create the payment data for a credit card
	  $creditCard = new AnetAPI\CreditCardType();
	  $creditCard->setCardNumber($request->credit_card_number );  
	  $creditCard->setExpirationDate($request->expiry_year.'-'.$request->expiry_month);
	  $creditCard->setCardCode($request->cvv);
	  $paymentOne = new AnetAPI\PaymentType();
	  $paymentOne->setCreditCard($creditCard);

	  // Create a transaction
	  $transactionRequestType = new AnetAPI\TransactionRequestType();
	  $transactionRequestType->setTransactionType("authCaptureTransaction");   
	  $transactionRequestType->setAmount($package->price);
	  $transactionRequestType->setPayment($paymentOne);
	  $request = new AnetAPI\CreateTransactionRequest();
	  $request->setMerchantAuthentication($merchantAuthentication);
	  $request->setRefId( $refId);
	  $request->setTransactionRequest($transactionRequestType);
	  $controller = new AnetController\CreateTransactionController($request);
	  $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);  

		if ($response != null) 
		{
		  $tresponse = $response->getTransactionResponse();
		  if (($tresponse != null) && ($tresponse->getResponseCode()=="1"))
		  {
            $payment  = new Payments();
            $payment->user_id = Auth::user()->id;
            $payment->package_id = $package->id;
            $payment->amount = $package->price;
            $payment->status = 'Available';
            $payment->save();

            return redirect()->route('shopCreate')->with('doneMessage','Payment Successfully Done!.');
            
		    echo "Charge Credit Card AUTH CODE : " . $tresponse->getAuthCode() . "\n";
		    echo "Charge Credit Card TRANS ID  : " . $tresponse->getTransId() . "\n";
		  }
		  else
		  {
		  	return redirect()->back()->with('errorMessage','Payment Failed. Please Try again.');
		    echo "Charge Credit Card ERROR :  Invalid response\n";
		  }
		}  
		else
		{
            return redirect()->back()->with('errorMessage','Invalid Credit Card details.');
		  echo  "Charge Credit Card Null response returned";
		}
    }

}
