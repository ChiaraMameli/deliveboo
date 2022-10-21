@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="d-flex justify-content-between mb-3">
            @if($dishes)
            <h1>I miei {{count($dishes)}} piatti</h1>
            @else
            <h1>I miei piatti</h1>
            @endif

            <div>
                <a class="btn btn-success" href="{{ route('admin.dishes.create') }}"><i class="fa-solid fa-plus"></i> Crea un nuovo piatto</a>
            </div>
        </div>

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
            @if($dishes)
            @foreach($dishes as $dish)
                <tr>
                    <td>{{$dish->id}}</td>
                    <th scope="row">{{$dish->name}}</th>
                    <td>{{$dish->setDescriptionExtract()}}</td>
                    <td>{{$dish->setIngredientsExtract()}}</td>
                    <td>{{$dish->setCommaOnPrice()}}</td>
                    <td>
                        <div class="d-flex">
                            <a class="btn btn-primary btn-sm ml-1" href="{{route('admin.dishes.show', $dish)}}"><i class="fa-solid fa-eye"></i></a>
                            <a class="btn btn-warning btn-sm ml-1" href="{{route('admin.dishes.edit', $dish)}}"><i class="fa-solid fa-pencil"></i></a>
                            <form action="{{route('admin.dishes.destroy', $dish->id)}}" method="POST" class="delete-form">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm ml-1"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            @else
                <tr>
                    <td colspan="6">Nessun piatto trovato</td>
                </tr>
            @endif
        </tbody>
        </table>
    </div>
@endsection
