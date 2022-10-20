<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    public function restaurant(){
        return $this->belongsTo('App\Models\Restaurant');
    }

    public function orders(){
        return $this->belongsToMany('App\Models\Order');
    }

    public function setDescriptionExtract(){
        return substr($this->description, 0, 30) . '...';
    }

    public function setIngredientsExtract(){
        return substr($this->ingredients, 0, 30) . '...';
    }


}
