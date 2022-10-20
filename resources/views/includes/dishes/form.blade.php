<div class="container">
@if($dish->exists)
    <form action="{{route('admin.dishes.update', $dish)}}" method="POST" novalidate>
    @method('PUT')
@else
    <form action="{{route('admin.dishes.store')}}" method="POST" novalidate>
@endif

    @csrf
    <div class="row">
        <div class="col-4 form-group">
            <label for="name">Nome</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name', $dish->name)}}">
            @error('name')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <div class="col-4 form-group">
            <label for="price">Prezzo</label>
            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{old('price', $dish->price)}}">
            @error('price')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <div class="col-4 form-group">
            <label for="size">Taglia</label>
            <input type="text" class="form-control @error('size') is-invalid @enderror" id="size" size="size" value="{{old('size', $dish->size)}}">
            @error('size')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>



        <div class="col-12 form-group">
            <label for="description">Descrizione</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5">{{old('description', $dish->description)}}</textarea>
            @error('description')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <div class="col-12 form-group">
            <label for="ingredients">Ingredienti</label>
            <textarea class="form-control @error('ingredients') is-invalid @enderror" id="ingredients" name="ingredients" rows="5">{{old('ingredients', $dish->ingredients)}}</textarea>
            @error('ingredients')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror

        </div>

        <div class="col-12 form-group">
            <label for="dish_image">Immagine</label>
            <input type="text" class="form-control @error('dish_image') is-invalid @enderror" id="dish_image" name="dish_image" value="{{old('dish_image', $dish->dish_image)}}">
            @error('dish_image')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror

        </div>

        <a href="{{route('admin.dishes.index', $dish)}}" class="btn btn-secondary ml-3"><i class="fa-solid fa-rotate-left"></i> Go Back</a>
        <div class="col-10"></div>
        <button type="submit" class="btn btn-primary align-self-end">{{$dish->exists ? 'Modifica' : 'Salva'}}</button>
    </div>
    </form>
</div>
