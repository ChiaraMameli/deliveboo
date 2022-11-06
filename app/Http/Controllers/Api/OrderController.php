<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Order;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {



        return Order::all();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request )
    {
                $data = $request->all();
        // dd($data);
        $order = new Order;
        //Order::create($request->all());
    //var_dump($data);
        $order->customer_name = $request->get('customer_name');
        $order->customer_email = $request->get('customer_email');
        $order->customer_phone = $request->get('customer_phone');
        $order->customer_address = $request->get('customer_address');
        $order->restaurant_id = $request->get('restaurant_id');
        $order->amount = $request->get('amount');
        $order->save();
        //$order->dishes()->attach($order->id);
        //$order->dishes()->sync(['quantity' => $data['quantity']]);
        $order->dishes()->attach([0 => [ 'dish_id' => $data['dish_id'], 'quantity' => $data['quantity']]]);
        //var_dump($order->id);
        //$order->dishes()->attach($data->$order_id);
        //$order->dishes()->attach($quantity['quantity']);
        return response()->json([
            'message' => 'creato nuovo ordine'
        ]);
    }
        // $data = $request->all();
        // // dd($data);
        // $order = new Order;
        // //Order::create($request->all());
        //  $order->customer_name = $request->get('customer_name');
        //  $order->customer_email = $request->get('customer_email');
        //  $order->customer_phone = $request->get('customer_phone');
        //  $order->customer_address = $request->get('customer_address');
        //  $order->restaurant_id = $request->get('restaurant_id');
        //  $order->amount = $request->get('amount');
        //  $order->save();
        //    $order->dishes()->attach($data['order_id']);
        // return response()->json([
        //     'message' => 'creato nuovo ordine'
        // ]);
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show(Order $order)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}