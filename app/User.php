<?php

namespace App;

use App\Post;
use App\FollowedPost;
use App\Reply;
use App\PostReactionLog;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname','lastname', 'email', 'password', 'street_name', 'user_type','confirmation_code','confirmation_status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts(){
        return $this->hasMany('App\Post','user_id');
    }

    public function followedPosts(){
        return $this->hasMany('App\FollowedPost','user_id');
    }

    public function replies(){
        return $this->hasMany('App\Reply','user_id');
    }

    public function postReactionsLog(){
        return $this->hasOne('App\PostReactionLog','user_id');
    }
}
