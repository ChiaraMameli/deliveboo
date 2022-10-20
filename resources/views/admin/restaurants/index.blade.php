@extends('layouts.app')
@section('content')
<div class="container">
    @if($restaurant_details->id)
    <a class="btn btn-success" href="{{route('admin.restaurants.show', $restaurant_details)}}">
        Vai a {{ $restaurant->restaurant_name}} </a>
    @else
    <p>Non hai ancora il tuo ristorante? </p>
    <a class="btn btn-outline-success p-2" href="{{ route('admin.restaurants.create') }}"> <i
            class="fa-solid fa-circle-plus"></i> Crealo ora!</a>
    @endif
</div>
@endsection
<!-- if($restaurant[0]['user_id']) -->