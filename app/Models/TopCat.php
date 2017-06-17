<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TopCat extends Model
{
    protected $table = 'topping_categories';

    protected $fillable = ['slug', 'title'];

    public function toppings(){
      return $this->hasMany('App\Models\Topping', 'topcat_id', 'id');
    }
}
