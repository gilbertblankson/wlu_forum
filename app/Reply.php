<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{   
    public $timestamps = false;

    protected $fillable = ['user_id','post_id','reply_body','created_at']; 
    
    public function replyOwner(){
        return $this->belongsTo('App\User','user_id');
    }
}
