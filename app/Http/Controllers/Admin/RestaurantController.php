<?php

namespace App\Http\Controllers\Admin;

use App\Models\Restaurant;
use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Restaurant $restaurant){
        
            $restaurant = new Restaurant;
           
            $my_restaurant = Restaurant::where('user_id', Auth::id())->get();

            // $restaurant_id= $my_restaurant[0]['id'];
            // $restaurant_name= $my_restaurant[0]['restaurant_name'];
            $restaurant_details = $my_restaurant[0];
            //dd($my_restaurant[0], $restaurant);

            return view('admin.restaurants.index', compact('restaurant_details'));
     
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Restaurant $restaurant)
    {
        $restaurant = new Restaurant();
        

        return view('admin.restaurants.create' , compact('restaurant'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //raccolgo tutti i dati dal form
        $data = $request->all();
        //! TODO VALIDATION 
        $request->validate([],[]);

        $restaurant = new Restaurant();

        $restaurant->fill($data);
        //slug   
        $restaurant->slug = Str::slug($restaurant->title , '-');

        $restaurant->user_id = Auth::id(); 
            
        $restaurant->save();
        
        return redirect()->route('admin.restaurants.show', $restaurant->id)
        ->with('message', 'Il ristaorante è stato creato con correttamente!')
        ->with('type', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        // $user_id = Auth::id();
        // $restaurant_id = $restaurant->user_id;
        // $restaurant = Restaurant::id();
        // $restaurant->user_id = Auth::id();

        // $restaurants = Restaurant::all();
        // $my_restaurant = $restaurants->where($user_id = $restaurant->user_id);

        // dd($my_restaurant);

        // $utente_loggato = Auth::id();
        // $proprietario = $restaurant->user_id;

        // if($utente_loggato = $proprietario){
        //    $restaurant = $restaurant->id;
        //    dd($restaurant);
        // }
        // $restaurant_id= $my_restaurant[0]['id'];
        // $restaurant_name= $my_restaurant[0]['restaurant_name'];
        $my_restaurant = Restaurant::where('user_id', Auth::id())->get();
        $restaurant_details = $my_restaurant[0];

        // $restaurant = json_decode(Restaurant::all()->where('user_id', auth()->user()->id));
        // $restaurant = Restaurant::where('user_id', Auth::id())->get();
        // dd($restaurant);
        return view('admin.restaurants.show', compact('restaurant_details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();

        return redirect()->route('admin.restaurants.index')
        ->with('message', 'Il restaurant è stato eliminato correttamente')
        ->with('type', 'success');
    }
}