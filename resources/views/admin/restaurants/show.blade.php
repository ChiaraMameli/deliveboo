@extends('layouts.app')

@section('content')
<div class="container">

    <header>
        <h1>{{ $restaurant_details->restaurant_name }}</h1>
    </header>
    <div class="clearfix">
        @if($restaurant_details->restaurant_image)
        <figure class="float-left mr-3">
            <img src=" {{ $restaurant_details->restaurant_image }}" alt="{{ $restaurant_details->restaurant_name }}">
        </figure>
        @endif
        <div class="my-3">
            <strong> Categoria ristorante: </strong>
            {{--    @foreach
        {{ $restaurant_details->category->label }}
            @endforeach --}}

        </div>
        <div class="my-3">
            <p class="mb-5"> Partita iva: {{ $restaurant_details->p_iva }} </p>
        </div>
        <div class="my-3">
            <strong> Indirizzo: </strong>
            {{$restaurant_details->address}}
        </div>
        <div class="my-3">
            <strong> Creato il: </strong> <time> {{ $restaurant_details->created_at }}</time>
        </div>
    </div>
    <footer class="d-flex align-items-center justify-content-between mt-5">

        <a href="{{ route('admin.restaurants.index') }}" class="btn btn-outline-primary">
            <i class="fa-solid fa-circle-left"> </i> Indietro ...
        </a>
        <div class="d-flex">

            <form action="{{ route('admin.restaurants.destroy', $restaurant_details->id )}}" method="POST" class="mx-2">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">
                    <i class="fa-solid fa-trash-can"></i> Elimina!
                </button>
            </form>
        </div>
    </footer>
</div>
@endsection