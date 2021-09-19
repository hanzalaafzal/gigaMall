<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chat;
use Auth;
use App\User;

class ChatController extends Controller
{
    public function random_chat_id(){
        $code =  substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 16);
        $chat_code = Chat::where('chat_id',$code)->first();
        if (count($chat_code)>0) {
            $this->random_chat_id();
        }
        else{
            return $code;
        }
    }
    public function chat($user_name,Chat $chat_code)
    {
        $receiver = User::where('user_name',$user_name)->first();
        if (count($receiver)==0 || $user_name == Auth::user()->user_name || $receiver->permissions_id == Auth::user()->permissions_id) {
        	return redirect()->back()->with('errorMessage','User Not Found!');
        }
        $chat_code = $chat_code->whereIn('user1_id',[Auth::user()->id,$receiver->id])
                            ->whereIn('user2_id',[Auth::user()->id,$receiver->id]);
        $chat_code = $chat_code->first();
        
        if(count($chat_code)==0){
            $chat_code = new Chat;
            $chat_code->user1_id = $receiver->id;
            $chat_code->user2_id = Auth::user()->id;
            $chat_code->chat_id = $this->random_chat_id();
            $chat_code->save();
        }

        $chat_all = Chat::where('user1_id',Auth::user()->id)
                            ->orWhere('user2_id',Auth::user()->id)
                            ->get();
        foreach ($chat_all as $chat) {
            if ($chat->user1_id != Auth::user()->id) {
                $users[] = User::find($chat->user1_id);
            }
            elseif($chat->user2_id != Auth::user()->id){
                $users[] = User::find($chat->user2_id);
            }
        }
        return view('frontEnd.chat.chat',compact('receiver','chat_code','users'));
    }

    public function inbox()
    {

        $chat_all = Chat::where('user1_id',Auth::user()->id)
                            ->orWhere('user2_id',Auth::user()->id)
                            ->get();
        if(count($chat_all)>0){
            foreach ($chat_all as $chat) {
                if ($chat->user1_id != Auth::user()->id) {
                    $users[] = User::find($chat->user1_id);
                }
                elseif($chat->user2_id != Auth::user()->id){
                    $users[] = User::find($chat->user2_id);
                }
            }
        }
        else{
            $users = array();
        }
        return view('frontEnd.chat.inbox',compact('users'));
    }
}
