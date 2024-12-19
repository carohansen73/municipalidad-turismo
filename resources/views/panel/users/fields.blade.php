<p class="text-muted">NOTA: Los campos con * son obligatorios.</p>
<div class="row">
    <!-- Name Field -->
    <div class="form-group col-sm-6">
        {!! Field::text('name', null, ['label' => 'Nombre *', 'autofocus', 'data-validation' => 'required length', 'data-validation-length' => '1-20']) !!}
    </div>

    <!-- Lastname Field -->
    <div class="form-group col-sm-6">
        {!! Field::text('lastname', null, ['label' => 'Apellido *', 'data-validation' => 'required length', 'data-validation-length' => '1-20']) !!}
    </div>
</div>

<div class="row">
    <!-- Password Field -->
    <div class="form-group col-sm-6">
        {!! Field::password('password', ['label' => 'Contraseña *', 'data-validation' => 'required length', 'data-validation-length' => '8-20']) !!}
    </div>

    <!-- Password confirmation Field -->
    <div class="form-group col-sm-6">
        {!! Field::password('password_confirmation', ['label' => 'Confirmar contraseña *', 'data-validation' => 'required length', 'data-validation-length' => '8-20']) !!}
    </div>
</div>

<div class="row">
    <!-- Email Field -->
    <div class="form-group col-sm-6">
        {!! Field::email('email', null, ['label' => 'Email *', 'data-validation' => 'email']) !!}
    </div>

    <div class="form-group col-sm-6">
        {!! Form::label('rol', 'Rol *') !!}
        {!! Form::select('rol', $roles, $user_role_id, ['class' => 'form-control select2', 'placeholder' => '- Seleccione una opción -', 'style' => 'width: 100%;', 'data-validation' => 'required']) !!}
    </div>
</div>

<div class="row">
    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('usuarios.index') !!}" class="btn btn-secondary">Cancelar</a>
    </div>
</div>

@section('scripts')
    @include('panel.partials.scripts.form-validator')
@endsection
