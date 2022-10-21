<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $fillable = [
        'name', 'description', 'ingredients', 'price', 'size', 'image'
    ];

    public function restaurant(){
        return $this->belongsTo('App\Models\Restaurant');
    }

    public function orders(){
        return $this->belongsToMany('App\Models\Order');
    }

    public function setDescriptionExtract(){
        if(strlen($this->description) > 30){
            return substr($this->description, 0, 30) . '...';
        }else return $this->description;
    }

    public function setIngredientsExtract(){
        if(strlen($this->ingredients) > 30){
            return substr($this->ingredients, 0, 30) . '...';
        }else return $this->ingredients;
    }

    public function setCommaOnPrice(){
        if(floatval($this->price)) return str_replace('.', ',', $this->price);
        return $this->price;
    }

}
