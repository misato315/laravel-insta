<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Like;//忘れない！！

use Illuminate\Support\Facades\Auth;//忘れない！！

class LikeController extends Controller
{
    private $like;

    public function __construct(Like $like_model){
        $this->like = $like_model;
    }

    public function store($post_id){
        $this->like->user_id = Auth::user()->id;
        $this->like->post_id = $post_id;
        $this->like->save();

        return redirect()->back();
    }

    public function destroy($post_id){
        $this->like
        ->where('user_id',Auth::user()->id)
        ->where('post_id',$post_id)
        ->delete();

        return redirect()->back();
    }



}
