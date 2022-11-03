<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Configuration;

class BraintreeController extends Controller
{
    public function index(){

        $gateway = new Braintree\Gateway([
        'environment' => config('services.braintree.environment'),
        'merchantId' => config('services.braintree.merchantId'),
        'publicKey' => config('services.braintree.publicKey'),
        'privateKey' => config('services.braintree.privateKey')
    ]);

    if($request->input('nonce') != null){
        var_dump($request->input('nonce'));
        $nonceFromTheClient = $request->input('nonce');
    
        $gateway->transaction()->sale([
            //passato il dato dal db
            'amount' => '10.00',
            'paymentMethodNonce' => $nonceFromTheClient,
            'options' => [
                'submitForSettlement' => True
            ]
        ]);
        return view ('dashboard');
    }

    $token = $gateway->ClientToken()->generate();

    return view('guest.home', ['token' => $token]);
    }
}