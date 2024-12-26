<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;

    // テーブルに自動的にタイムスタンプが付与されない場合はこのプロパティを設定
    public $timestamps = false;

    // ユーザーとのリレーション
    public function user(){
        
        return $this->belongsTo(User::class);
    }

    // ポストとのリレーション
    // public function post()
    // {
    //     return $this->belongsTo(Post::class);
    // }
}
