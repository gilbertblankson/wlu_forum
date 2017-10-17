<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NumberOfView extends Model
{
    protected $table = "number_of_views";
    public $timestamps = false;
    protected $fillable = ['user_id','post_id'];
}
