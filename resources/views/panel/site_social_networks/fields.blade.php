<p class="text-muted">NOTA: Los campos con * son obligatorios.</p>
<div class="row">
    <!-- Social network id Field -->
    <div class="form-group col-sm-6">
        {!! Field::select('social_network_id', $social_networks, null, ['label' => 'Red social *', 'empty' => '- Selecciona una red social -', 'data-validation' => 'required numeric']) !!}
    </div>

    <!-- URL Field -->
    <div class="form-group col-sm-6">
        {!! Field::text('url', null, ['label' => 'Link *', 'data-validation' => 'required length', 'data-validation-length' => '1-191']) !!}
    </div>
</div>

<div class="row">
    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('sitio.redes.index') !!}" class="btn btn-secondary">Cancelar</a>
    </div>
</div>

@section('scripts')
    @include('panel.partials.scripts.form-validator')
@endsection
