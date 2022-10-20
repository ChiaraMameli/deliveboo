@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="card" style="width: 25rem;">
                <img src="{{$dish->dish_image}}" class="card-img-top img-fluid" alt="{{$dish->name}}">
                <div class="card-body">
                    <h5 class="card-title text-center">{{$dish->name}}</h5>
                    <p class="card-text"><strong>Descrizione:</strong> {{$dish->description}}</p>
                    <p class="card-text"><strong>Ingredienti:</strong> {{$dish->ingredients}}</p>
                    <p class="card-text"><strong>Prezzo:</strong> {{$dish->price}}</p>

                    <div class="card-footer">
                        <a href="{{route('admin.dishes.index')}}" class="btn btn-dark">Torna indietro</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
