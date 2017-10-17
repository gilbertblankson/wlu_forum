<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostReaction extends Model
{
    protected $table = "post_reactions";
    public $timestamps = false;
    
    protected $fillable = ['post_id','number_of_likes','number_of_dislikes'];
}
