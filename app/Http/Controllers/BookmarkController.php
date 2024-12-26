<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Bookmark;
use Illuminate\Support\Facades\Auth;


class BookmarkController extends Controller
{
    private $bookmark;

    public function __construct(Bookmark $bookmark_model){
        $this->bookmark = $bookmark_model;
    }


    public function store($post_id){
        $this->bookmark->user_id = Auth::user()->id;
        $this->bookmark->post_id = $post_id;
        $this->bookmark->save();

        return redirect()->back();
    }

    public function destroy($post_id){
        $this->bookmark
        ->where('user_id',Auth::user()->id)
        ->where('post_id',$post_id)
        ->delete();

        return redirect()->back();
    }
}
