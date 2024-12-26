<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Follow;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    private $follow;

    public function __construct(Follow $follow_model){
        $this->follow = $follow_model;
    }

    #To follow a user
    #フォローする
    public function store($user_id){
        $this->follow->follower_id  = Auth::user()->id;
        $this->follow->following_id = $user_id;
        $this->follow->save();

        return redirect()->back();
    }

    #フォロー解除
    public function destroy($user_id){
        $this->follow
        ->where('follower_id',Auth::user()->id)
        ->where('following_id',$user_id)
        ->delete();

        return redirect()->back();
    }

    
}
