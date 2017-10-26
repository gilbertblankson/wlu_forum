<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public $timestamps = false;

    protected $fillable = ['user_id','hashtag','file_name','uploaded_at'];
}
