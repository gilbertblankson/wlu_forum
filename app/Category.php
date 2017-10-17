<?php

namespace App;

use App\Post;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['category_alias'];

    public function posts(){
        return $this->hasMany('App\Post','category_id');
    }
}
