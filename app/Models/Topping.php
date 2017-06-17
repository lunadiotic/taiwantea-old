<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topping extends Model
{
    protected $fillable = ['topcat_id', 'slug', 'name', 'image', 'price'];

    public function category(){
      return $this->belongsTo('App\Models\TopCat', 'topcat_id', 'id');
    }
}
