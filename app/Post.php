<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = ['id', 'user_id', 'post'];

    //リレーション
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

}
