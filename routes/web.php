<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Order;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::get('/', function () {
//     return view('guest.home');
// });

Auth::routes();


Route::middleware('auth')->prefix('admin')->namespace('Admin')->name('admin.')->group(function(){

    Route::get('/', 'HomeController@index')->name('home');

    //Restaurant routes
    Route::resource('restaurants', 'RestaurantController');

    //Toggle is_visible route
    Route::patch('dishes/{dish}/toggle', 'DishController@toggle')->name('dishes.toggle');

    //Dish routes
    Route::resource('dishes', 'DishController');

    //Orders routes
    Route::resource('orders', 'OrderController');

    Route::get('/{any}', function(){
        abort('404');
    })->where('any', '.*' );    
});

// PAYMENTS ROUTES
Route::get('/payment', function(){

    $gateway = new Braintree\Gateway([
        'environment' => config('services.braintree.environment'),
        'merchantId' => config('services.braintree.merchantId'),
        'publicKey' => config('services.braintree.publicKey'),
        'privateKey' => config('services.braintree.privateKey'),
    ]);


    $token = $gateway->ClientToken()->generate();

   $amount = Order::all()->last()->amount;

  
    return view('braintree', ['token' => $token, 'amount' => $amount]);

});

Route::post('/checkout', function(Request $request){

    $gateway = new Braintree\Gateway([
        'environment' => config('services.braintree.environment'),
        'merchantId' => config('services.braintree.merchantId'),
        'publicKey' => config('services.braintree.publicKey'),
        'privateKey' => config('services.braintree.privateKey'),
    ]);

    $amount = $request->amount;
    $nonce = $request->payment_method_nonce;

    $result = $gateway->transaction()->sale([
        'amount' => $amount,
        'paymentMethodNonce' => $nonce,
        'options' => [
            'submitForSettlement' => true
        ]
    ]);
//! (||!is_null($result->transaction) --- DA VERIFICARE CHE QUESTO ULTERIORE CONTROLLO FUNZIONI(PER I VALORI NEGATIVI)
    if ($result->success) {
        $transaction = $result->transaction;

        header('Location: ' . 'http://127.0.0.1:8000/thank-you-page');
        die();
    
    } else {
        $errorString = "";

        foreach($result->errors->deepAll() as $error) {
            $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
        }

        // $_SESSION["errors"] = $errorString;
        // header("Location: " . $baseUrl . "index.php");

        return back()->withErrors('Transazione Fallita' . $result->message);

    }
});

//Guest routes
Route::get('/{any?}', function () {
    return view('guest.home');
})->where('any', '.*' );