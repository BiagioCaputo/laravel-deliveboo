@if ($dish->exists)
    <form action="{{ route('admin.dishes.update', $dish->id) }}" enctype="multipart/form-data" method="POST"
        class="dishes-form" id="dish-edit-form" novalidate>
        @method('PUT')
    @else
        <form action="{{ route('admin.dishes.store') }}" enctype="multipart/form-data" method="POST" class="dishes-form"
            id="dish-create-form" novalidate>
@endif
@csrf
<div class="row">

    {{--   Nome piatto   --}}
    <div class="col-6">
        <div class="mb-3">
            <label for="name" class="form-label">Nome Piatto<span class="text-danger">*</span></label>
            <input type="text"
                class="form-control @error('name') is-invalid @elseif(old('name', '')) is-valid  @enderror"
                id="name" name="name" placeholder="Nome Piatto" value="{{ old('name', $dish->name) }}" required>
            <div class="form-text">
                <p class="m-0" id="dish-name-suggest"></p>
            </div>
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    {{--   Immagine Piatto  --}}
    <div class="col-8">
        <div class="mb-3">
            <label for="image" class="form-label">Immagine</label>

            <div @class(['input-group', 'd-none' => !$dish->image]) id="previous-image-field">
                <button class="btn btn-outline-secondary" type="button" id="change-image-button">Inserisci
                    immagine</button>
                <input type="text" class="form-control" value="{{ old('image', $dish->image) }}" disabled>
            </div>

            <input type="file"
                class="form-control @if ($dish->image) d-none @endif @error('image') is-invalid @elseif(old('image', '')) is-valid @enderror"
                id="image" name="image" placeholder="http:// o https://">

            @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="col-1">
        <div class="mb-3">
            <img src="{{ old('image', $dish->image) ? asset('storage/' . $dish->image) : 'https://marcolanci.it/boolean/assets/placeholder.png' }}"
                class="img-fluid" alt="img-post" id="preview">
        </div>
    </div>

    {{-- Ingredienti --}}
    <div class="col-12">
        <div class="mb-3">
            <label for="ingredients" class="form-label">Ingredienti<span class="text-danger">*</span></label>
            <textarea type="text" rows="3"
                class="form-control @error('ingredients') is-invalid @elseif(old('ingredients', '')) is-valid  @enderror"
                id="ingredients" name="ingredients" placeholder="Inserisci gli ingredienti" required>{{ old('ingredients', $dish->ingredients) }}</textarea>
            <div class="form-text">
                <p class="m-0" id="ingredients-suggest"></p>
            </div>
            @error('ingredients')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    {{-- Prezzo --}}
    <div class="col-4">
        <div class="mb-3">
            <label for="price" class="form-label">Prezzo<span class="text-danger">*</span></label>
            <input type="number" step="0.1"
                class="form-control @error('price') is-invalid @elseif(old('price', '')) is-valid  @enderror"
                id="price" name="price" placeholder="Es: 4,50" value="{{ old('price', $dish->price) }}" required>
            <div class="form-text">
                <p class="m-0" id="price-suggest"></p>
            </div>
            @error('price')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    {{-- Descrizione Piatto --}}
    <div class="col-10">
        <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>
            <textarea type="text" rows="5"
                class="form-control @error('description') is-invalid @elseif(old('description', '')) is-valid  @enderror"
                id="description" name="description" placeholder="Descrizione">{{ old('description', $dish->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    {{--   Portata  --}}
    <div class="col-3">
        <div class="mb-3">
            <label for="course_id" class="form-label">Portata</label>
            <select class="form-select" name="course_id" id="course_id"
                @error('course_id') is-invalid @elseif (old('course_id', '')) is-valid @enderror>
                <option value="">--Seleziona portata</option>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}" @if (old('course_id', $dish->course?->id) == $course->id) selected @endif>
                        {{ $course->label }}</option>
                @endforeach
            </select>
            @error('course_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    {{-- Disponibilità --}}
    <div class="col-12">
        <div class="form-check form-switch my-3">
            <label class="form-check-label" for="available">Visibile
                <input class="form-check-input" type="checkbox" role="button" id="available" name="available"
                    value="1" @if (old('available', $dish->available)) checked @endif>
            </label>
        </div>
    </div>

    {{--   Buttons   --}}
    <div class="d-flex justify-content-end my-2">
        <button class="btn btn-success"><i class="fa-solid fa-floppy-disk me-2"></i>Salva</button>
    </div>
</div>
</form>

@section('scripts')
    @vite('resources/js/dish_forms_validation.js')
    @vite('resources/js/image_preview.js') 
@endsection

<script>
    const dishes = @json($dishes)
</script>
