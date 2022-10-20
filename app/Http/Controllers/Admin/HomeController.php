<?php

namespace App\Http\Controllers\Admin;

use App\Models\Restaurant;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){

        $my_restaurant = Restaurant::where('user_id', Auth::id())->get();
        $restaurant_details = $my_restaurant[0];
        return view('admin.home', compact('restaurant_details'));
    }
}