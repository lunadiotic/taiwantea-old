<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['category_id', 'slug', 'name', 'image', 'price'];

    public function category(){
      return $this->belongsTo('App\Models\Category');
    }
}
