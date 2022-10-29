<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Configuration;

class BraintreeController extends Controller
{
    public function index(){

        $config = new Braintree\Configuration([
        'environment' => config('services.braintree.environment'),
        'merchantId' => config('services.braintree.merchantId'),
        'publicKey' => config('services.braintree.publicKey'),
        'privateKey' => config('services.braintree.privateKey')
    ]);

    $gateway = new Braintree\Gateway($config);

    $token = $gateway->ClientToken()->generate();

    return view('guest.home', ['token' => $token]);
    }
}
