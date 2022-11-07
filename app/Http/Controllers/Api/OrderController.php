<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\User;
use App\Mail\OrderMail;
use App\Mail\CustomerOrderMail;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


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
        //valido
        //var_dump($data);
        $validator = Validator::make($data , [
            'costumer_name' => 'required|string|min:2',
            'costumer_email' => 'required|email',
            'costumer_phone' => 'required|numeirc|max:15',
            'costumer_address' => 'required',
        ],[
            'costumer_name.required' => 'Inserisci il tuo nome e cognome per procedere',
            'costumer_name.string' => 'Il nome e il cognome non devono contenere numeri',
            'costumer_name.min' => 'Il nome e il cognome devono essere veri',
            'costumer_email.required' => 'Inserisci la tua email per procedere',
            'costumer_email.email' => 'Ops! La mail non è stata inserita correttamente. Controlla e riprova',
            'costumer_phone.required' => 'Inserisci il tuo numero di telefono per procedere',
            'costumer_phone.numeric' => 'Il numero di telefono deve essere composto da soli numeri',
            'costumer_phone.max' => 'Il numero di telefono inserito è troppo lungo',
            'costumer_address.required' => 'Inserisci il tuo indirizzo per procedere',
        ]);
        //se non passa, li mando indietro
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        //Order::create($request->all());
        //var_dump($data); 
        $order->customer_name = $request->get('customer_name');
        $order->customer_email = $request->get('customer_email');
        $order->customer_phone = $request->get('customer_phone');
        $order->customer_address = $request->get('customer_address');
        $order->restaurant_id = $request->get('restaurant_id');
        $order->amount = $request->get('amount');
        $order->save();
     
       $dishes = json_decode($data['cart_dishes']);
        foreach ($dishes as $dish) {
         $order->dishes()->attach(['dish_id' => $dish->id], [ 'quantity' => $dish->quantity]);
    };
   

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


        return response('Mail inviata' , 204);
    }
 

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