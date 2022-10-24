<div class="container">
@if($dish->exists)
    <form action="{{route('admin.dishes.update', $dish)}}" enctype="multipart/form-data" method="POST" novalidate>
    @method('PUT')
@else
    <form action="{{route('admin.dishes.store')}}" enctype="multipart/form-data" method="POST" novalidate>
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

        <div class="col-10 input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupFileAddon01">Carica</span>
            </div>
            <div class="custom-file">
                <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="image" name="image" aria-describedby="inputGroupFileAddon01">
                <label class="custom-file-label" for="image">Scegli la tua immagine</label>

                @error('image')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
        </div>

        <div class="col-2">
            <img src="{{$dish->image ? asset('storage/' . $dish->image) : 'https://image.shutterstock.com/image-vector/ui-image-placeholder-wireframes-apps-260nw-1037719204.jpg'}}" alt="{{$dish->name}}" class="img-fluid rounded">
        </div>

        <div class="col-12 d-flex justify-content-between">
            <a href="{{route('admin.dishes.index', $dish)}}" class="btn btn-dark"><i class="fa-solid fa-rotate-left"></i> Torna indietro</a>
            <button type="submit" class="btn btn-primary align-self-end"><i class="fa-solid fa-{{$dish->exists ? 'pencil' : 'floppy-disk'}}"></i> {{$dish->exists ? 'Modifica' : 'Salva'}}</button>
        </div>
    </div>
    </form>
</div>
