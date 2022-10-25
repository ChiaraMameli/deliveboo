<?php

namespace App\Http\Controllers\Admin;

use App\Models\Restaurant;
use App\Models\User;
use App\Models\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Restaurant $restaurant){
        
            
           
            $my_restaurant = Restaurant::where('user_id', Auth::id())->get();
                //  dd(compact($restaurant));
            if(isset($my_restaurant[0])){
                $restaurant_details = $my_restaurant[0];
                return view('admin.home', compact('restaurant','restaurant_details'));   
            }else{
                return view('admin.restaurants.index', compact('restaurant'));   
            }
     
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Restaurant $restaurant)
    {
       
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
        $data = $request->all();

        
        $request->validate([
            'name' => 'required|string|min:1|max:50|unique:restaurants',
            'p_iva' => 'required|string|min:1|max:13|unique:restaurants',
            'address' => 'required|string|unique:restaurants',
            'image' => 'nullable|image',
            'category_id' => 'required|exists:categories,id',
        ],[
            'name.required' => 'Attenzione, inserisci il nome del tuo ristorante per poter procedere',
            'name.max' => 'Attenzione,il nome del ristorante non può avere più di 50 caratteri.',
            'p_iva.required' => 'Attenzione, inserisci la partita IVA per procedere' ,
            'p_iva.max' => 'Attenzione, la partita IVA dev\'essere di massimo 13 caratteri' ,
            'address.required' => 'Attenzione, è necessario l\'indirizzo del tuo ristorante per procedere',
            'image.image' => 'Il file scelto non è di tipo immagine',
            'category_id.exists','category_id.required' => 'Seleziona almeno una categoria per procedere'
        ]);

        $restaurant = new Restaurant();

        $restaurant->fill($data);

        if(array_key_exists('image', $data)){
            $link = Storage::put('restaurants', $data['image']);
            $restaurant->image = $link;
        }

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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
     public function edit(Restaurant  $restaurant)
    {

        $categories = Category::all();
        $categories_ids = $restaurant->categories->pluck('id')->toArray();
        return view('admin.restaurants.edit', compact('restaurant', 'categories' ,  'categories_ids'));

    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        
        $validated = $request->validate([
          'name' => ['required','string','max:50',   Rule::unique('restaurants')->ignore($restaurant->id)],
            'p_iva' => ['required','string','max:13', Rule::unique('restaurants')->ignore($restaurant->id)],
            'address' => ['required','string', Rule::unique('restaurants')->ignore($restaurant->id)],
            'image' => 'nullable|image',
            'category_id' => 'required|exists:categories,id',
        ],[
            'name.required' => 'Attenzione, inserisci il nome del tuo ristorante per poter procedere',
            'name.max' => 'Attenzione,il nome del ristorante non può avere più di 50 caratteri.',
            'p_iva.required' => 'Attenzione, inserisci la partita IVA per procedere' ,
            'p_iva.max' => 'Attenzione, la partita IVA dev\'essere di massimo 13 caratteri' ,
            'address.required' => 'Attenzione, è necessario l\'indirizzo del tuo ristorante per procedere',
            'image.image' => 'Il file scelto non è di tipo immagine',
            'category_id.exists','category_id.required' => 'Seleziona almeno una categoria per procedere'
        ]);


        $data = $request->all();

        if(array_key_exists('image', $data)){
            if($restaurant->image) Storage::delete($restaurant->image);
            $link = Storage::put('restaurants', $data['image']);
            $restaurant->image = $link;
        }

        $restaurant->update($data);
        $restaurant->categories()->sync($data['category_id']);
        return redirect()->route('admin.restaurants.show', $restaurant)->with('message', 'La modifica è avvenuta con successo')->with('type', 'success');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        if($restaurant->image) Storage::delete($restaurant->image);
        $restaurant->delete();

        return redirect()->route('admin.restaurants.index', 'restaurant')
        ->with('message', 'Il ristorante è stato eliminato correttamente')
        ->with('type', 'success');
    }
}