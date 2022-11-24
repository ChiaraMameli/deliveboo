@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between bg-white">
        <div class="p-4">
            <h3>Dettagli dell'ordine</h3>
            <p class="d-block"><strong>Nome:</strong> {{ $order->customer_name }}</p>
            <p class="d-block"><strong>Numero di telefono:</strong> {{ $order->customer_phone }}</p>
            <p class="d-block"><strong>Indirizzo mail:</strong> {{ $order->customer_email }}</p>
            <p class=""><strong>Totale:</strong> {{ $order->amount }}€</p>
            <p class=""><strong>Indirizzo di consegna:</strong> {{ $order->customer_address }}</p>
            <p class=""><strong>Data di creazione:</strong> {{ $order->created_at }}</p>
        </div>
        <div class="p-4">
            <h3>Piatti ordinati</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nome piatto</th>
                        <th scope="col">Quantità</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($order->dishes as $dish)
                    <tr>
                        <td>{{ $dish->name }}</td>
                        <td>{{ $dish->pivot->quantity }}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>


        </div>


    </div>
    <div class="card-footer d-flex justify-content-between">
        <a href="{{ route('admin.orders.index') }}" class="btn btn-dark">Torna indietro</a>
        <div class="d-flex">
            {{-- <form class="delete-form" action="{{ route('admin.dishes.destroy', $order->id) }}" method="POST">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-danger ml-1">Elimina</button>
            </form>--}}
        </div>
    </div>
</div>
@endsection