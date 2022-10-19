@extends('layouts.app')
@section('content')
<div class="container">

    <a class="btn btn-success" href="{{route('admin.restaurants.show', $restaurant_id , $restaurant_name)}}">
        Vai a .. {{ $restaurant_name }}</a>
</div>
@endsection