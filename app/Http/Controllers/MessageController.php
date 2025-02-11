<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{

    private $message;

    public function view($user_id){
        $all_messages = $this->message->all();

        return view('users.message')->with('message',$message);
    }

    public function send(Request $request){
        $request->validate([
            'receiver_id'=>'required|exist:users,id',
            'message'=>'required|string'
        ]);

        $message = Message::create([
            'sender_id'=>Auth::id(),
            'receiver_id'=>$request->receiver_id,
            'message'=>$request->message
        ]);

        return redirect()->back()->with('success','メッセージが送信されました。');

    }

    


}
