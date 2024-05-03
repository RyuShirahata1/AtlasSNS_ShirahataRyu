<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password', 'bio', // 'bio'フィールドを追加
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

     public function isFollowing($user_id)
    {
        return $this->follows()->where('followed_id', $user_id)->exists();
    }

    public function follows()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'followed_id');
    }

    public function follow($user_id)
    {
        $this->follows()->attach($user_id);
    }

    public function unfollow($user_id)
    {
        $this->follows()->detach($user_id);
    }
}
