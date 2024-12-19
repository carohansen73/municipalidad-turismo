<p class="text-muted">NOTA: Los campos con * son obligatorios.</p>
<div class="row">
    <!-- Title Field -->
    <div class="form-group col-sm-6">
        {!! Field::text('title', null, ['label' => 'Título *', 'autofocus', 'data-validation' => 'required length', 'data-validation-length' => '1-191']) !!}
    </div>

     <!-- Content Field -->
     {{-- <div class="form-group col-sm-12 col-lg-12">
        {!! Form::label('Descripción *') !!}
        {!! Form::textarea('description', null, ['class' => 'form-control my-editor', 'data-validation' => 'required']) !!}
    </div> --}}

    <!-- Important Image Field -->
    {{-- <div class="form-group col-sm-6">
        @if(Request::is('posts/crear'))
            {!! Field::file('important_image', ['label' => 'Imagen destacada *', 'data-validation' => 'required mime', 'data-validation-allowing' => 'jpg, jpeg, png, bmp, svg']) !!}
        @else
            {!! Field::file('important_image', ['label' => 'Imagen destacada *', 'data-validation' => 'mime', 'data-validation-allowing' => 'jpg, jpeg, png, bmp, svg']) !!}
        @endif
    </div> --}}
</div>

<div class="row">
    <div class="form-group col-sm-6">
        {!! Field::text('location_city', null, ['label' => 'Ciudad *', 'data-validation' => 'required length', 'data-validation-length' => '1-191']) !!}
    </div>

    <div class="form-group col-sm-6">
        {!! Field::text('location_address', null, ['label' => 'Dirección *', 'data-validation' => 'required length', 'data-validation-length' => '1-19']) !!}
    </div>
</div>

<div class="row">
    <div class="form-group col-sm-6">
        {!! Field::text('price', null, ['label' => 'precio', 'data-validation' => 'required length', 'data-validation-length' => '1-191']) !!}
    </div>

    <div class="form-group col-sm-6">
        {!! Field::text('capacity', null, ['label' => 'Capacidad máxima *', 'data-validation' => 'required length', 'data-validation-length' => '1-300']) !!}
    </div>
</div>

<div class="row">
    {{-- <div class="form-group col-sm-12 col-lg-12">
        {!! Form::label('Consideraciones *') !!}
        {!! Form::textarea('considerations', null, ['class' => 'form-control my-editor', 'data-validation' => 'required']) !!}
    </div> --}}
</div>


<div class="row">

    <div class="form-group col-sm-6">

        {{-- <select name="service_id" class="form-control" id="serviceSelect" required>
            <option value=''>selecione aqui</option>
            @foreach($services as $service)
                <option value={!! $service->id !!}>{!! $service->name !!}</option>
            @endforeach
        </select> --}}

        {{-- {!! Field::select('service_id', $services,  null, ['label' => 'Tipo de servicio *', 'placeholder' => '- Selecciona un tipo de servicio -', 'data-validation' => 'required', 'id' => 'serviceSelect']) !!} --}}
        {!! Form::select('service_id', $services, null, ['label' => 'Tipo de servicio *', 'placeholder' => '- Selecciona un tipo de servicio -', 'data-validation' => 'required', 'id' => 'serviceSelect']) !!}


    </div>

    <div class="form-group col-sm-6">
        {!! Field::select('service_type_id[]', [],  ['label' => 'Comodidades', 'multiple' => 'multiple', 'id' => 'amenitiesSelect']) !!}
    </div>


    <!-- Post Category Id Field -->
    {{-- <div class="form-group col-sm-6">
        {!! Form::label('Categoría *') !!}
        {!! Form::select('post_category_id',
        , null, ['label' => 'Categoría *', 'placeholder' => '- Selecciona una categoría -', 'data-validation' => 'required']) !!}
    </div>

    <div class="form-group col-sm-6">
        {!! Field::select('post_tag_id[]', $post_tags, $my_tags, ['label' => 'Tags', 'multiple']) !!}
    </div> --}}

</div>

{{--
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

    <!-- 'bootstrap / Toggle Switch Publish Field' -->
    <div class="d-flex align-items-center form-group col-sm-6">
        {!! Form::label('signature_author', 'Firmar') !!}
        <label class="switch switch-label switch-pill switch-primary  ml-2">
            {!! Form::hidden('signature_author', 0) !!}
            {!! Form::checkbox('signature_author', 1, null,  ['class' => 'switch-input']) !!}
            <span class="switch-slider" data-checked="Si" data-unchecked="No"></span>
        </label>
    </div>
</div>

<div class="row">
    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('posts.index') !!}" class="btn btn-secondary">Cancelar</a>
    </div>
</div> --}}





    <!-- Place the following <script> and <textarea> tags your HTML's <body> -->

    {{-- <textarea>
      Welcome to TinyMCE!
    </textarea> --}}

    <script src="{{ asset('js/service-ajax.js') }}"></script>
@section('scripts')
    @include('panel.partials.scripts.tinymce-full')
    @include('panel.partials.scripts.form-validator')
    @include('panel.partials.scripts.datetimepicker')
@endsection


