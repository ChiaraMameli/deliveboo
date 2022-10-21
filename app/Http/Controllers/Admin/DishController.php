<?php

namespace App\Http\Controllers\Admin;

use App\Models\Dish;
use App\Models\Restaurant;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dishes = null;

        $my_restaurant = Restaurant::where('user_id', Auth::id())->get();
        $all_dishes = Dish::all();

        foreach($all_dishes as $dish){
            if($my_restaurant[0]['id'] === $dish['restaurant_id']) $dishes[] = $dish;
        };

        return view('admin.dishes.index', compact('dishes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dish = new Dish();
        return view('admin.dishes.create', compact('dish'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:1|max:30|string',
            'ingredients' => 'required',
            'price' => 'required',
            'image' => 'nullable|url',

        ],
        [
            'required' => 'Questo campo non può rimanere vuoto',
            'string' => 'Il formato non è valido',
            'name.min' => "$request->name è troppo corto",
            'name.max' => "$request->name è troppo lungo",
            'image.url' => 'Il formato non è valido',
        ]);


        $data = $request->all();
        $my_restaurant = Restaurant::where('user_id', Auth::id())->get();
        $dish = new Dish();
        $dish->restaurant_id = $my_restaurant[0]['id'];
        $dish->fill($data);
        $dish->save();

        return redirect()->route('admin.dishes.index')->with('message', 'Il piatto è stato creato con successo')->with('type', 'success');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function show(Dish $dish)
    {
        return view('admin.dishes.show', compact('dish'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function edit(Dish $dish)
    {
        return view('admin.dishes.edit', compact('dish'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dish $dish)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:1|max:30|string',
            'ingredients' => 'required',
            'price' => 'required',
            'image' => 'nullable|url',

        ],
        [
            'required' => 'Questo campo non può rimanere vuoto',
            'string' => 'Il formato non è valido',
            'name.min' => "$request->name è troppo corto",
            'name.max' => "$request->name è troppo lungo",
            'image.url' => 'Il formato non è valido',
        ]);


        $data = $request->all();
        $dish->update($data);
        return redirect()->route('admin.dishes.show', $dish)->with('message', 'Il post è stato modificato correttamente')->with('type', 'success');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish)
    {
        $dish = Dish::destroy($dish->id);
        return redirect()->route('admin.dishes.index')->with('message', 'Il post è stato eliminato con successo!')->with('type', 'success');
    }
}
