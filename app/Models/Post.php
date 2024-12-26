<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{

    use SoftDeletes;
    
    #A post belongs to a user
    #To get the owner of the post
    public function user(){
        return $this->belongsTo(User::class)->withTrashed();
    }


    #To get tge categories under a post
    public function categoryPost(){
        return $this->hasMany(CategoryPost::class);
    }

    #To get all the comments under a post
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    #To get the likes of a post
    public function likes(){
        return $this->hasMany(Like::class);
    }

    #Return TRUE if the Auth user already like the post
    public function isLiked(){
        return $this->likes()->where('user_id',Auth::user()->id)->exists();
    }


    #ポストを保存したユーザーを取得するリレーション
    public function bookmarks(){
        return $this->hasMany(Bookmark::class);
    }

    #Return TRUE if the Auth user already like the post
    public function isBookmarked(){
        return $this->bookmarks()->where('user_id',Auth::user()->id)->exists();
    }
    

}
