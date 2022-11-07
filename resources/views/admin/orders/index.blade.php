@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="d-flex justify-content-between mb-3">
            @if($orders)
            <h2>I miei {{count($orders)}} ordini</h2>
            @else
            <h2>Non hai ancora ordini</h2>
            @endif
        </div>

        @if ($orders)
        <table class="table table-hover">
        <thead>
            <tr>
            <th scope="col">id</th>
            <th scope="col">Totale</th>
            <th scope="col">Nome</th>
            <th scope="col">Numero di telefono</th>
            <th scope="col">Email</th>
            <th scope="col">Indirizzo</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->amount}}€</td>
                    <td>{{$order->customer_name}}</td>
                    <td>{{$order->customer_phone}}</td>
                    <td>{{$order->customer_email}}</td>
                    <td>
                        <div class="d-flex">
                            <a class="btn btn-primary btn-sm ml-1" href="{{route('admin.orders.show', $order)}}"><i class="fa-solid fa-eye"></i></a>
                            <form action="{{route('admin.orders.destroy', $order->id)}}" method="POST" class="delete-form">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm ml-1"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Nessun ordine</td>
                </tr>
            @endforelse
        </tbody>
        </table>
        @endif
    </div>
@endsection
