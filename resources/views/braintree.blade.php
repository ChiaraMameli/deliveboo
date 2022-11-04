<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="{{asset('js/front.js')}}" defer></script>
    <script src="https://js.braintreegateway.com/web/dropin/1.33.4/js/dropin.min.js"></script>

</head>

<body>
    <div class="flex-center position-ref full-height">
        {{--    @if (Route::has('login'))
        <div class="top-right links">
            @auth
            <a href="{{ route('admin.home') }}">Home</a>
        @else
        <a href="{{ route('login') }}">Login</a>

        @if (Route::has('register'))
        <a href="{{ route('register') }}">Register</a>
        @endif
        @endauth
    </div>
    @endif --}}


    <!-- MESSAGIO DI AVVENUTA TRANSAZIONE -->
    @if(session('success_message'))
    <div class="alert alert-success">
        {{ session('success_message') }}
    </div>
    @endif

    <!-- MESSAGGIO TRANSAZIONE FALLITA -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="d-flex justify-content-center text-center">
        <div id="dropin-container" style="width: 20rem">
            <form method="post" id="payment-form" action="/checkout">
                @csrf
                <section>
                    <label for="amount">
                        <span class="input-label">Amount</span>
                        <div class="input-wrapper amount-wrapper">
                            <!-- gestire dal cart in storage amount da passare -->
                            <input id="amount" name="amount" type="tel" min="1" placeholder="Amount" value="10">
                        </div>
                    </label>

                    <div class="bt-drop-in-wrapper">
                        <div id="bt-dropin"></div>
                    </div>
                </section>

                <input id="nonce" name="payment_method_nonce" type="hidden" />
                <button class="button" type="submit"><span>Test Transaction</span></button>
            </form>
        </div>

    </div>
    </div>
</body>

<script>
const form = document.querySelector('#payment-form');
const client_token = "{{ $token }}";

braintree.dropin.create({
    authorization: client_token,
    selector: '#bt-dropin',
    paypal: {
        flow: 'vault'
    }
}, function(createErr, instance) {
    if (createErr) {
        console.log('Create Error', createErr);
        return;
    }
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        instance.requestPaymentMethod(function(err, payload) {
            console.log(payload)
            if (err) {
                console.log('Request Payment Method Error', err);
                return;
            }

            // Add the nonce to the form and submit
            document.querySelector('#nonce').value = payload.nonce;
            form.submit();
        });
    });
});
</script>

</html>