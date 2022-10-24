<div class="container">
    <div id="error-restaurant" class="col-12 alert" role="alert">
    </div>
    @if($restaurant->exists)
    <header>
        <h2> Modifica il tuo ristorante </h2>
    </header>
    <form id="form-restaurant" action="{{route('admin.restaurants.update', $restaurant)}}" method="POST" novalidate>
        @method('PUT')
        @else
        <header>
            <h2> Crea il tuo ristorante </h2>
        </header>
        <form id="form-restaurant" action="{{route('admin.restaurants.store')}}" method="POST" novalidate>
            @endif
            @csrf
            <div class="row">
                <div class="col-12">
                    <p> N.B.: I campi contrassegnati dall'asterisco (*) sono obbligatori</p>
                </div>
                <!-- Nome ristorante -->
                <div class="mb-3 col-12">
                    <label for="name" class="form-label"> Nome ristorante* </label>
                    <input class="form-control  @error('name') is-invalid @enderror" type="text" id="name" name="name"
                        value=" {{ old('name', $restaurant->name) }} " maxlenght="50">
                    @error('name')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <!-- partita iva -->
                <div class="mb-3 col-12">
                    <label for="p_iva" class="form-label">Numero partita IVA *</label>
                    <input class="form-control  @error('p_iva') is-invalid @enderror" type="text" id="p_iva"
                        name="p_iva" value=" {{ old('p_iva', $restaurant->p_iva) }} " maxlenght="13">
                    @error('p_iva')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <!-- indirizzo-->
                <div class="mb-3 col-12">
                    <label for="address" class="form-label">Indirizzo completo* </label>
                    <input class="form-control  @error('address') is-invalid @enderror" type="text" id="address"
                        name="address" value=" {{ old('address', $restaurant->address) }} ">
                    @error('address')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <!-- immagine -->
                <div class="mb-3 col-10">
                    <label for="image" class="form-label">Immagine </label> <br>
                    <input class="@error('image') is-invalid @enderror" type="file" id="image" name="image">
                </div>
                <div class="mb-3 col-2">
                    <img class="img-fluid"
                        src="https://image.shutterstock.com/image-vector/ui-image-placeholder-wireframes-apps-260nw-1037719204.jpg"
                        alt="placeholder" id="preview">
                    @error('image')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <!-- multi-checkboxs tipologie ristoranti-->

                <div class="mb-3 col-12">
                    <h5> Categorie risotrante*</h5>
                    @error('category_id')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                    <div class="d-flex">

                        @foreach($categories as $category)
                        <div class="form-group form-check m-2">
                            <!-- # gestire checked al create -->
                            <input type="checkbox" id="{{$category->label}}" name="category_id[]"
                                value="{{ $category->id }}" class="form-check-input " @if(in_array($category->id,
                            old('categories', $categories_ids ?? []))) checked
                            @endif>
                            <label class="form-check-label" for="{{$category->label}}"> {{$category->label}} </label>
                        </div>
                        @endforeach
                    </div>

                </div>



            </div>

            <footer class="d-flex justify-content-between align items-center">
                <a href="{{ $restaurant->exists ? route('admin.restaurants.show' , $restaurant) : route('admin.home') }}"
                    class="btn btn-outline-info">
                    <i class="fa-solid fa-circle-left"> </i> Indietro ...
                </a>

                <button type="submit" class="btn btn-outline-success">
                    <i class="fa-solid fa-floppy-disk"></i> Salva!
                </button>
            </footer>

        </form>
</div>