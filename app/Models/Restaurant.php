<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function categories(){
        return $this->belongsToMany('App\Models\Category');
    }

    public function dishes(){
        return $this->hasMany('App\Models\Dish');
    }

}
