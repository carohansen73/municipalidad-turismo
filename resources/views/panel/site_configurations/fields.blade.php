<p class="text-muted">NOTA: Los campos con * son obligatorios.</p>
<div class="row">
    <!-- Title Places Field -->
    <div class="form-group col-sm-6">
        {!! Field::text('title_place', null, ['label' => 'Título sección lugares *', 'data-validation' => 'required length', 'data-validation-length' => '1-191']) !!}
    </div>
    
    <!-- Subtitle Places Field -->
    <div class="form-group col-sm-6">
        {!! Field::text('subtitle_place', null, ['label' => 'Subtítulo sección lugares *', 'data-validation' => 'required length', 'data-validation-length' => '1-191']) !!}
    </div>
</div>

<div class="row">
    <!-- Title News Field -->
    <div class="form-group col-sm-6">
        {!! Field::text('title_news', null, ['label' => 'Título sección noticias *', 'data-validation' => 'required length', 'data-validation-length' => '1-191']) !!}
    </div>
    
    <!-- Subtitle News Field -->
    <div class="form-group col-sm-6">
        {!! Field::text('subtitle_news', null, ['label' => 'Subtítulo sección noticias *', 'data-validation' => 'required length', 'data-validation-length' => '1-191']) !!}
    </div>
</div>

<div class="row">
    <!-- Title Events Field -->
    <div class="form-group col-sm-6">
        {!! Field::text('title_events', null, ['label' => 'Título sección eventos *', 'data-validation' => 'required length', 'data-validation-length' => '1-191']) !!}
    </div>
    
    <!-- Subtitle Events Field -->
    <div class="form-group col-sm-6">
        {!! Field::text('subtitle_events', null, ['label' => 'Subtítulo sección eventos *', 'data-validation' => 'required length', 'data-validation-length' => '1-191']) !!}
    </div>
</div>

<div class="row">
    <!-- Title Team Field -->
    <div class="form-group col-sm-6">
        {!! Field::text('title_team', null, ['label' => 'Título sección equipo *', 'data-validation' => 'required length', 'data-validation-length' => '1-191']) !!}
    </div>
    
    <!-- Subtitle Team Field -->
    <div class="form-group col-sm-6">
        {!! Field::text('subtitle_team', null, ['label' => 'Subtítulo sección equipo *', 'data-validation' => 'required length', 'data-validation-length' => '1-191']) !!}
    </div>
</div>

<div class="row">
    <div class="form-group col-sm-6">
        {!! Field::file('logo_main', ['label' => 'Logo principal']) !!}
        <p class="text-muted">NOTA: Tamaño del logo 125x30 px.</p>
    </div>

    <div class="form-group col-sm-6">
        {!! Field::file('logo_panel', ['label' => 'Logo panel']) !!}
        <p class="text-muted">NOTA: Tamaño del logo 150x150 px.</p>
    </div>
</div>

<div class="row">
    <!-- Description Team Field -->
    <div class="form-group col-sm-12 col-lg-12">
        {!! Field::textarea('description_team', null, ['class' => 'form-control my-editor', 'label' => 'Texto o frase del equipo *']) !!}
    </div>
    
    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('dashboard') !!}" class="btn btn-secondary">Cancelar</a>
    </div>
</div>

@section('scripts')
    @include('panel.partials.scripts.tinymce-minimal')
    @include('panel.partials.scripts.form-validator')
@endsection