<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostReactionLog extends Model
{
    protected $table = "post_reactions_logs";
    public $timestamps = false;
    protected $fillable = ['user_id','post_id','reaction_type_id'];
}
