<?php

namespace App\Models;

//HasFactoryはUSERモデルからコピしてくる
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Like extends Model
{
    use HasFactory;

    public $timestamps = false;

       // ユーザーとのリレーション
       public function user()
       {
           return $this->belongsTo(User::class);
       }

}
