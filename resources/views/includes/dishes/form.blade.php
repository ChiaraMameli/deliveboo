<div class="container">
    <div id="error" class="col-12 alert" role="alert">
    </div>
@if($dish->exists)
    <form id="form" action="{{route('admin.dishes.update', $dish)}}" enctype="multipart/form-data" method="POST">
    @method('PUT')
@else
    <form id="form" action="{{route('admin.dishes.store')}}" enctype="multipart/form-data" method="POST">
@endif

    @csrf
    <div class="row">
        <div class="col-8 form-group">
            <label for="name">Nome*</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name', $dish->name)}}">
            @error('name')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <div class="col-4 form-group">
            <label for="price">Prezzo*</label>
            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" step="0.01" value="{{old('price', $dish->price)}}" novalidate>
            @error('price')
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
            <label for="ingredients">Ingredienti*</label>
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
                <input id="image-field" type="file" class="custom-file-input @error('image') is-invalid @enderror" id="image" name="image" aria-describedby="inputGroupFileAddon01">
                <label class="custom-file-label" for="image"></label>

                @error('image')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
        </div>

        <div class="col-2">
            <img id="image-preview" src="{{$dish->image ? asset('storage/' . $dish->image) : 'https://image.shutterstock.com/image-vector/ui-image-placeholder-wireframes-apps-260nw-1037719204.jpg'}}" alt="{{$dish->name}}" class="img-fluid rounded">
        </div>

        <div class="col-12 d-flex justify-content-between">
            <a href="{{route('admin.dishes.index', $dish)}}" class="btn btn-dark"><i class="fa-solid fa-rotate-left"></i> Torna indietro</a>
            <button type="submit" class="btn btn-primary align-self-end"><i class="fa-solid fa-{{$dish->exists ? 'pencil' : 'floppy-disk'}}"></i> {{$dish->exists ? 'Modifica' : 'Salva'}}</button>
        </div>
    </div>
    </form>
    <div class="col-12 alert alert-info mt-5" role="alert">
        I campi contrassegnati con * sono obbligatori!
      </div>
</div>
