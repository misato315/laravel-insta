<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    #全てのカテゴリーを取得する
   public function categories(){
    return $this->hasMany(Post::class);
    }
}
