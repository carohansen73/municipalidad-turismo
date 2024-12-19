<p class="text-muted">NOTA: Los campos con * son obligatorios.</p>
<div class="row">
    <!-- Name Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('name', 'Nombre *') !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'autofocus', 'data-validation' => 'required length', 'data-validation-length' => '1-50']) !!}
    </div>

    <!-- Icon Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('icon', 'Icono *') !!}
        {!! Form::text('icon', null, ['class' => 'form-control', 'data-validation' => 'required length', 'data-validation-length' => '1-50']) !!}
    </div>
</div>

<div class="row">
    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('redes.index') !!}" class="btn btn-secondary">Cancelar</a>
    </div>
</div>

@section('scripts')
    @include('panel.partials.scripts.form-validator')
@endsection