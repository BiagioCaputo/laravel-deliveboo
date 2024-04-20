@if($restaurant->exists)
<form action="{{route('admin.restaurant.update', $restaurant)}}" enctype="multipart/form-data" method="POST">
    @method('PUT')
@else
<form action="{{route('admin.restaurant.store')}}" enctype="multipart/form-data" method="POST">
@endif
@csrf
    <div class="row">

        {{--   Nome attività   --}}
        <div class="col-6">
            <div class="mb-4">
                <label for="activity_name" class="form-label">Nome Ristorante</label>
                <input type="text" class="form-control @error('activity_name') is-invalid @elseif(old('activity_name', '')) is-valid  @enderror" id="activity_name" name="activity_name" placeholder="Nome Ristorante" value="{{old('activity_name', $restaurant->activity_name)}}">
                @error('activity_name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>

        {{--   Slug   --}}
        {{-- <div class="col-6">
            <div class="mb-4">
                <label for="slug" class="form-label">Slug??</label> --}}
                {{-- <input type="text" class="form-control" id="slug" value="{{ Str::slug(old('activity_name', $restaurant->activity_name)) }}" disabled> --}}
            {{-- </div>
        </div> --}}


        {{--  Description  --}}
        <div class="col-12">
            <div class="mb-5">
                <label for="description" class="form-label">Descrizione</label>
                <textarea class="form-control @error('description') is-invalid @elseif(old('description', '')) is-valid @enderror" id="description" name="description" rows="8">
                    {{old('description', $restaurant->description)}}
                </textarea>
                @error('description')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>


        {{--   Vat   --}}
        <div class="col-6">
            <div class="mb-4">
                <label for="vat" class="form-label">Vat 11 car.</label>
                <input type="text" class="form-control @error('vat') is-invalid @elseif(old('vat', '')) is-valid  @enderror" id="vat" name="vat" placeholder="P.IVA Ristorante" value="{{old('vat', $restaurant->vat)}}">
                @error('vat')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>

        {{--   Email   --}}
        <div class="col-6">
            <div class="mb-4">
                <label for="email" class="form-label">Email Ristorante</label>
                <input type="text" class="form-control @error('email') is-invalid @elseif(old('email', '')) is-valid  @enderror" id="email" name="email" placeholder="Email del Ristorante" value="{{old('email', $restaurant->email)}}">
                @error('email')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>

        {{--   address   --}}
        <div class="col-6">
            <div class="mb-4">
                <label for="address" class="form-label">Indirizzo</label>
                <input type="text" class="form-control @error('address') is-invalid @elseif(old('address', '')) is-valid  @enderror" id="address" name="address" placeholder="Indirizzo del Ristorante" value="{{old('address', $restaurant->address)}}">
                @error('address')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>


        {{--   Immagine   --}}
        <div class="col-8">
            <div class="mb-5">
                <label for="image" class="form-label">Immagine</label>


                <div @class(['input-group', 'd-none' => !$restaurant->image]) id="previous-image-field">
                    <button class="btn btn-outline-secondary" type="button" id="change-image-button">Cambia immag.</button>
                    <input type="text" class="form-control" value="{{old('image', $restaurant->image)}}" disabled>
                </div>



                <input type="file" class="form-control @if ($restaurant->image) d-none @endif @error('image') is-invalid @elseif(old('image', '')) is-valid @enderror" id="image" name="image"  placeholder="http:// o https://">



                @error('image')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-1">
            <div class="mb-5">
                <img src="{{old('image', $restaurant->image) ? $restaurant->printImage() : 'https://marcolanci.it/boolean/assets/placeholder.png'}}" class="img-fluid" alt="img-post" id="preview">
            </div>
        </div>


        {{--   Tipologie  --}}
        <div class="col-10">
            @foreach ($types as $type)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" name="types[]" 
                    type="checkbox" id="tech-{{$type->id}}" value="{{$type->id}}"
                    @if(in_array($type->id, old('types', $previous_types ?? []))) checked @endif>
                    <label class="form-check-label" for="tech-{{$type->id}}">{{$type->label}}</label>
                </div>
            @endforeach
            @error('types')
                <div class="invalid-feedback">
                     {{ $message }}
                </div>
            @enderror
        </div>
        <hr>

        {{--   Buttons   --}}
        <div class="d-flex justify-content-end my-5">
            <button class="btn btn-success"><i class="fa-solid fa-plus me-2"></i>Conferma</button>
        </div>
    </div>
</form>