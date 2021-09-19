<?php

namespace App\Http\Controllers;
use App\Coupon;
use App\Wallet;
use App\WebmasterSection;
use App\ProductType;
use App\WalletTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function wallets()
    {
    $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $wallets = Wallet::with('users')->paginate(15);
        
       // dd($types);
      // dd($wallets);
        return view('backEnd.wallets.wallets',compact('GeneralWebmasterSections','wallets','types'));

    }
    public function walletDebitShow($id)
    { //echo $id;die();
    $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
    $wallet = Wallet::where('id',$id)->with('users')->first();
    
        
        return view('backEnd.wallets.debit',compact('GeneralWebmasterSections','wallet','types','id'));

    }
    public function walletCreditShow($id)
    {   //echo "credit";
        //echo $id;die();
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $wallet = Wallet::where('id',$id)->with('users')->first();
        $types = ProductType::all();
        return view('backEnd.wallets.credit',compact('GeneralWebmasterSections','wallet','types','id'));

    }
    public function walletEdit($id)
    {   echo "Edit";
        echo $id;die();
    $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $wallet = Wallet::with('users')->get();
        $types = ProductType::all();
        return view('backEnd.wallets.wallets',compact('GeneralWebmasterSections','wallet','types'));

    }
    public function deductFromWallet(Request $request)
    { $input=$request->all();
        $transaction_date = Carbon::now()->toDateString();
       // var_dump($input);die();
       $walletForDeduction=Wallet::find($input['walletId']);
       $walletForDeduction->amount-=$input['deductionAmount'];
       $walletForDeduction->save();
       


       $insertTransaction=WalletTransaction::create(['transaction_type'=>'deduction','transaction_amount'=>$input['deductionAmount'],'transaction_date'=>$transaction_date,'transaction_head'=>$input['deductionHead'],'user_id'=>$input['user_id']]);
       return redirect()->back()->with('doneMessage', 'Amount Deducted from Wallet!');
         
    }
    public function addFromWallet(Request $request)
    { $input=$request->all();
        $transaction_date = Carbon::now()->toDateString();
       //var_dump($input);die();
       $walletForDeduction=Wallet::find($input['walletId']);
       $walletForDeduction->amount+=$input['additionAmount'];
       $walletForDeduction->save();
       $insertTransaction=WalletTransaction::create(['transaction_type'=>'addition','transaction_amount'=>$input['additionAmount'],'transaction_date'=>$transaction_date,'transaction_head'=>$input['additionHead'],'user_id'=>$input['user_id']]);
       return redirect()->back()->with('doneMessage', 'Amount Added to account successfully!');
         
    }
    public function walletHistoryShow($id)
    { 
         //echo $id;die();
    $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
    $walletHistoy = WalletTransaction::where('user_id',$id)->get();
    
        //dd($walletHistoy);
        return view('backEnd.wallets.wallet_history',compact('GeneralWebmasterSections','walletHistoy','id'));

    }
    public function historyFilters(Request $request)
    {   $input=$request->all();
        //var_dump($input);die();
        
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $walletHistoy = WalletTransaction::where('user_id',$input['user_id'])->where('transaction_date','>=',$input['start_date'])->where('transaction_date','<=',$input['end_date'])->get();
            $id=$input['user_id'];
            return view('backEnd.wallets.wallet_history',compact('GeneralWebmasterSections','walletHistoy','id'));
    
    
    }
}
