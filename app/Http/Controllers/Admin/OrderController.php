<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Dish;
use App\Models\Restaurant;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = null;

        $my_restaurant = Restaurant::where('user_id', Auth::id())->get();
        $all_orders = Order::all();
        //aggiungere altra condizione nell'if, per casistica nuovo risto
        foreach($all_orders as $order){
            if($my_restaurant[0]['id'] === $order['restaurant_id']) $orders[] = $order;
        }
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $my_restaurant = Restaurant::where('user_id', Auth::id())->get();
        if($order->restaurant_id !== $my_restaurant[0]['id']){
            return redirect()->route('admin.orders.index')->with('message', 'Non puoi visualizzare questo ordine')->with('type', 'warning');
        }

        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order = Order::destroy($order->id);
        return redirect()->route('admin.orders.index')->with('message', 'L\'ordine è stato eliminato con successo!')->with('type', 'success');
    }
}
