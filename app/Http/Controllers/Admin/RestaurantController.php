<?php

namespace App\Http\Controllers\Admin;

use App\Models\Restaurant;
use App\Models\User;
use App\Models\Category;

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
    public function index(){
        
            
           
            $my_restaurant = Restaurant::where('user_id', Auth::id())->get();
             //dd($my_restaurant);
            if(isset($my_restaurant[0])){
                $restaurant_details = $my_restaurant[0];
                return view('admin.restaurants.index', compact('restaurant_details'));   
            }else{
                return view('admin.restaurants.index', compact('my_restaurant'));   
            }
     
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Restaurant $restaurant)
    {
        $restaurant = new Restaurant();
        $categories = Category::all();

        return view('admin.restaurants.create' , compact('restaurant', 'categories'));
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

        
        $request->validate([
            'restaurant_name' => 'required|string|min:1|max:50|unique:restaurants',
            'p_iva' => 'required|string|min:1|max:13|unique:restaurants',
            'address' => 'required|string|unique:restaurants',
            'restaurant_image' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
        ],[
            'required' => 'Attenzione, il campo :attribute è obbbligatorio',
            'restaurant_name.required' => 'Attenzione, devi dare un nome al tuo ristorante per poter procedere',
            'restaurant_name.max' => 'Attenzione,il nome del ristorante non può avere più di 50 caratteri.',
            'restaurant_name.min' => 'Attenzione, ci dev\'essere un nome ristorante per procedere' ,
            'restaurant_name.unique' => 'Attenzione, il nome scelto per il ristorante è già stato adootato da un altro ristoratore',
            'p_iva.min' => 'Attenzione, inserisci la partita IVA per procedere' ,
            'p_iva.max' => 'Attenzione, la partita IVA dev\'essere di massimo 13 caratteri' ,
            'p_iva.unique' => 'Attenzione, la partita IVA inserita risulta associata ad un altro ristoratore',
            'address.required' => 'Attenzione, è necessario l\'indirizzo del tuo ristorante per procedere',
            'address.unique' => 'Attenzione, l\'indirizzo inserito è già associato ad un altro ristoratore',
            'category_id.exists' => 'Seleziona almeno una categoria per procedere'
        ]);

        $restaurant = new Restaurant();

        $restaurant->fill($data);

        $restaurant->user_id = Auth::id(); 

        $restaurant->save();
        
        $restaurant->categories()->attach($data['category_id']);
        
        return redirect()->route('admin.restaurants.show', $restaurant->id)
        ->with('message', 'Il ristorante è stato creato correttamente!')
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
        $my_restaurant = Restaurant::where('user_id', Auth::id())->get();
        $restaurant_details = $my_restaurant[0];   
        return view('admin.restaurants.show', compact('restaurant_details'));
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

        return redirect()->route('admin.restaurants.index', 'restaurant')
        ->with('message', 'Il restaurant è stato eliminato correttamente')
        ->with('type', 'success');
    }
}