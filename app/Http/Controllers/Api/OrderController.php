<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\User;
use App\Mail\OrderMail;
use App\Mail\CustomerOrderMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;


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
        //ciclare gli id e le quantità
       // $order->dishes()->attach($data['cart_dishes']);
       $dishes = json_decode($data['cart_dishes']);
        foreach ($dishes as $dish) {
         $order->dishes()->attach(['dish_id' => $dish->id], [ 'quantity' => $dish->quantity]);
    };
        //var_dump($data['cart_dishes']);
       // $order->dishes()->attach([[ 'dish_id' => $data['dish_id'], 'quantity' => $data['quantity']]]);
        //$order->dishes()->attach($order->id);
        //$order->dishes()->sync(['quantity' => $data['quantity']]);
        //  foreach ($order->dishes as $dish) {
        //     $dish()->attach($data['dish_id'], ['quantity' => $data['quantity']]);
        //  };

        $restaurant_id = $request->get('restaurant_id');
        $restaurant = Restaurant::where('id', $restaurant_id)->get();
        $user_id = $restaurant[0]->user_id;
        $user = User::where('id', $user_id)->get();
        $user_email = $user[0]->email;

        $mail_owner = new OrderMail();
        $mail_customer = new CustomerOrderMail();
        $restaurant_owner = $user_email;
        $customer = $request->get('customer_email');
        Mail::to($restaurant_owner)->send($mail_owner);
        Mail::to($customer)->send($mail_customer);


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