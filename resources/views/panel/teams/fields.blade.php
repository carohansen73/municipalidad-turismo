<p class="text-muted">NOTA: Los campos con * son obligatorios.</p>
<div class="row">
    <!-- Name Field -->
    <div class="form-group col-sm-6">
        {!! Field::text('name', null, ['label' => 'Nombre *', 'autofocus', 'data-validation' => 'required length', 'data-validation-length' => '1-80']) !!}
    </div>

    <!-- Important Image Field -->
    <div class="form-group col-sm-6">
        @if(Request::is('equipo/crear'))
            {!! Field::file('important_image', ['label' => 'Imagen / Avatar *', 'data-validation' => 'required mime', 'data-validation-allowing' => 'jpg, jpeg, png, bmp, svg']) !!}
        @else
            {!! Field::file('important_image', ['label' => 'Imagen / Avatar *', 'data-validation' => 'mime', 'data-validation-allowing' => 'jpg, jpeg, png, bmp, svg']) !!}
        @endif
    </div>
</div>

<div class="row">
    <!-- Job Field -->
    <div class="form-group col-sm-12">
        {!! Field::text('job', null, ['label' => 'Trabajo / Puesto *', 'data-validation' => 'required length', 'data-validation-length' => '1-30']) !!}
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
    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('equipo.index') !!}" class="btn btn-secondary">Cancelar</a>
    </div>
</div>

@section('scripts')
    @include('panel.partials.scripts.form-validator')
@endsection

