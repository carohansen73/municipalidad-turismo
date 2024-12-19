<p class="text-muted">NOTA: Los campos con * son obligatorios.</p>
<div class="row">
    <!-- Title Field -->
    <div class="form-group col-sm-6">
        {!! Field::text('title', null, ['label' => 'Título *', 'autofocus', 'data-validation' => 'required length', 'data-validation-length' => '1-60', 'maxlength' => 60]) !!}
    </div>

    <!-- Summary Field -->
    <div class="form-group col-sm-6">
        {!! Field::text('summary', null, ['label' => 'Resumen *', 'data-validation' => 'required length', 'data-validation-length' => '1-160', 'maxlength' => 160]) !!}
    </div>

</div>

<div class="row">
    <!-- Important Image Field -->
    <div class="form-group col-sm-12">
        @if(Request::is('lugar/crear'))
            {!! Field::file('important_image', ['label' => 'Imagen destacada *', 'data-validation' => 'required mime', 'data-validation-allowing' => 'jpg, jpeg, png, bmp, svg']) !!}
        @else
            {!! Field::file('important_image', ['label' => 'Imagen destacada *', 'data-validation' => 'mime', 'data-validation-allowing' => 'jpg, jpeg, png, bmp, svg']) !!}
        @endif
    </div>
</div>
<div class="clearfix"></div>

<div class="row">
    <!-- Content Field -->
    <div class="form-group col-sm-12 col-lg-12">
        {!! Form::label('Contenido *') !!}
        {!! Form::textarea('content', null, ['class' => 'form-control my-editor', 'data-validation' => 'required']) !!}
    </div>
</div>

<div class="row">
    <!-- Important Image Field -->
    <div class="form-group col-sm-12">
        {!! Field::file('galery[]', ['label' => 'Agregar galería de imágenes', 'multiple' => 'multiple', 'data-validation' => 'mime', 'data-validation-allowing' => 'jpg, jpeg, png, bmp, svg']) !!}
    </div>
</div>

<div class="row">
    <!-- 'bootstrap / Toggle Switch Publish Field' -->
    <div class="d-flex align-items-center form-group col-sm-6">
        {!! Form::label('publish', 'Publicar') !!}
        <label class="switch switch-label switch-pill switch-primary  ml-2">
            {!! Form::hidden('publish', 0) !!}
            {!! Form::checkbox('publish', 1, null,  ['class' => 'switch-input']) !!}
            <span class="switch-slider" data-checked="Si" data-unchecked="No"></span>
        </label>
    </div>
</div>

<div class="row">
    <!-- Place Category Id Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('Categoría *') !!}
        {!! Form::select('place_category_id', $place_categories, null, ['label' => 'Categoría *', 'placeholder' => '- Selecciona una categoría -', 'data-validation' => 'required']) !!}
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('lugar.index') }}" class="btn btn-secondary">Cancelar</a>
</div>

@section('scripts')
    @include('panel.partials.scripts.tinymce-full')
    @include('panel.partials.scripts.form-validator')
@endsection
