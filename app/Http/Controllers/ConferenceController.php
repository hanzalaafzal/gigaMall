<?php

namespace App\Http\Controllers;
use App\OrderProducts;
use App\Conference;
use Auth;
use Illuminate\Http\Request;

class ConferenceController extends Controller
{
    public function videoConference()
    {//echo "conferencing controller";die();
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
     if(Auth::user()->permissions_id==4){
        return view('frontEnd.vendor.video.videoClient', compact('orders', 'count'));
     }else{
    return view('frontEnd.vendor.video.video', compact('orders', 'count'));
     }

    }
    public function audioConference()
    {//echo "conferencing controller audio section";die();
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
     if(Auth::user()->permissions_id==4){
        return view('frontEnd.vendor.audio.audioClient', compact('orders', 'count'));
     }else{
    return view('frontEnd.vendor.audio.audio', compact('orders', 'count'));
     }

    }
    public function updateChat($dvid,$roomid){
        $data['status'] = 0; 
        $data['dvid']=$dvid;
        $data['roomid']=$roomid;
        $insertConference=Conference::create(['owner_user_id'=>Auth::user()->id,'room_number'=>$roomid,'chat_id'=>$dvid]);

        return response()->json($data);
         
    
    
    }
    public function videoBroadcast()
    {//echo "braodcast controller";die();
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
     if(Auth::user()->permissions_id==4){
        return view('frontEnd.vendor.broadcast.broadcastClient', compact('orders', 'count'));
     }else{
    return view('frontEnd.vendor.broadcast.broadcast', compact('orders', 'count'));
     }

    }
}
