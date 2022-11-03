@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="card" style="width: 25rem;">
            @if($dish->image)
                <img src="{{asset('storage/' . $dish->image)}}" class="card-img-top img-fluid" alt="{{$dish->name}}">
            @endif
                <div class="card-body">
                    <h5 class="card-title text-center">{{$dish->name}}</h5>
                    <p class="card-text"><strong>Descrizione:</strong> {{$dish->description}}</p>
                    <p class="card-text"><strong>Ingredienti:</strong> {{$dish->ingredients}}</p>
                    <p class="card-text"><strong>Prezzo:</strong>€ {{$dish->setCommaOnPrice()}}</p>

                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{route('admin.dishes.index')}}" class="btn btn-dark"> Torna indietro</a>
                        <div class="d-flex">
                            <a class="btn btn-warning" href="{{route('admin.dishes.edit', $dish)}}">Modifica</a>
                            <form action="{{route('admin.dishes.destroy', $dish)}}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger ml-1">Elimina</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
