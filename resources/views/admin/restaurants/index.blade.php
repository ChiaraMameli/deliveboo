@extends('layouts.app')

@section('content')
    <div class="container">
        <a class="btn btn-success" href="{{route('admin.restaurants.show', $restaurant)}}">pippo</a>
    </div>
@endsection
