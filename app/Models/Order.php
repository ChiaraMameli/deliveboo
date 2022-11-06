<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function restaurant(){
        return $this->belongsTo('App\Models\Restaurant');
    }

        public function dishes(){
        return $this->belongsToMany('App\Models\Dish')->withPivot('');
    }

    protected $fillable = ['customer_name','customer_email','costumer_phone','costumer_address','amount','restaurant_id'];
}