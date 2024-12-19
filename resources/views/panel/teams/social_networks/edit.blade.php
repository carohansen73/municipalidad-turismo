@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
         <a href="{!! route('social.network.list', $social_network->team_id) !!}">Listado de redes</a>
      </li>
      <li class="breadcrumb-item active">Editar</li>
    </ol>
     <div class="container-fluid">
          <div class="animated fadeIn">
                @include('coreui-templates::common.errors')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-plus-square-o fa-lg"></i>
                                <strong>Editar red social</strong>
                            </div>
                            <div class="card-body">
                                {!! Form::open(['route' => ['social.network.update', $social_network->id], 'method' => 'PUT', 'autocomplete' => 'off']) !!}
                                <p class="text-muted">NOTA: Los campos con * son obligatorios.</p>
                                    <div class="row">
                                        <!-- Social network id Field -->
                                        <div class="form-group col-sm-6">
                                                {!! Field::select('social_network_id', $social_networks, $social_network->social_network_id, ['label' => 'Red social *', 'empty' => '- Selecciona una red social -', 'data-validation' => 'required numeric']) !!}
                                            </div>

                                            <!-- URL Field -->
                                            <div class="form-group col-sm-6">
                                                {!! Field::text('url', $social_network->url, ['label' => 'Link *', 'data-validation' => 'required length', 'data-validation-length' => '1-100']) !!}
                                            </div>
                                    </div>

                                    <div class="row">
                                            <!-- Submit Field -->
                                            <div class="form-group col-sm-12">
                                                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                                                <a href="{!! route('social.network.list', $social_network->team_id) !!}" class="btn btn-secondary">Cancelar</a>
                                            </div>
                                    </div>

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
           </div>
    </div>
@endsection

@section('scripts')
    @include('panel.partials.scripts.form-validator')
@endsection