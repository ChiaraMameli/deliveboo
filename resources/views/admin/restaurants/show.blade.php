@extends('layouts.app')

@section('content')
<div class="container">

    <header>
        <h1>Nome ristorante: {{ $restaurant_details->restaurant_name }}</h1>
    </header>
    <div class="d-flex flex-column">
        <div class="my-3">
            <p>
            <h3> Partita iva: </h3> {{ $restaurant_details->p_iva }} </p>
        </div>
        <div class="my-3">
            <h3> Indirizzo: </h3>
            {{$restaurant_details->address}}
        </div>
        @if($restaurant_details->restaurant_image)
        <figure>
            <p>
            <h3> Immagine ristorante: </h3>
            </p>
            <img src=" {{ $restaurant_details->restaurant_image }}" alt="{{ $restaurant_details->restaurant_name }}">
        </figure>
        @endif
        <div class="my-3">
            <h3> Categoria ristorante: </h3>
            {{--    @foreach
                <!-- problema: come stampo le categorie in  pagina ? -->
                {{ $restaurant_details->category->label }}
            @endforeach --}}

        </div>
        <div class="my-3">
            <h3> Creato il: </h3> <time> {{ $restaurant_details->created_at }}</time>
        </div>
    </div>
    <footer class="d-flex align-items-center justify-content-between mt-5">

        <a href="{{ route('admin.home' , $restaurant_details) }}" class="btn btn-outline-primary">
            <i class="fa-solid fa-circle-left"> </i> Torna alla home
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