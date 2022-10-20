@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table table-hover">
        <thead>
            <tr>
            <th scope="col">id</th>
            <th scope="col">Nome</th>
            <th scope="col">Descrizione</th>
            <th scope="col">Ingredienti</th>
            <th scope="col">Prezzo</th>
            <th scope="col">Azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dishes as $dish)
                <tr>
                    <td>{{$dish->id}}</td>
                    <th scope="row">{{$dish->name}}</th>
                    <td>{{$dish->setDescriptionExtract()}}</td>
                    <td>{{$dish->setIngredientsExtract()}}</td>
                    <td>{{$dish->price}}</td>
                    <td>
                        <div class="d-flex">
                            <a class="btn btn-primary" href="{{route('admin.dishes.show', $dish)}}">Show</a>
                            <form action="{{route('admin.dishes.destroy', $dish->id)}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">Elimina</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
        </table>
    </div>
@endsection
