<?php

namespace App;

use App\Reply;
use App\Category;
use App\User;
use App\NumberOfView;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['user_id','category_id','post_title','post_body','moderated','created_at','updated_at','last_edited_at'];

    public function postReplies(){
        return $this->hasMany('App\Reply','post_id');
    }

    public function parentCategory(){
        return $this->belongsTo('App\Category','category_id');
    }

    public function owner(){
        return $this->belongsTo('App\User','user_id');
    }

    public function postReaction(){
        return $this->hasOne('App\PostReaction','post_id');
    }

    public function numberOfViews(){
        return $this->hasMany('App\NumberOfView','post_id');
    }
}
