<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Restaurant;

class HomeController extends Controller
{
    public function index(){
        // $restaurants = Restaurant::all();
        // $restaurant_id = $restaurant->user_id;
        // $restaurants = auth()
        return view('admin.home');
    }
}
