@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
          <li class="breadcrumb-item">
             <a href="{!! route('sitio.redes.index') !!}">Redes sociales del sitio</a>
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
                              <i class="fa fa-edit fa-lg"></i>
                              <strong>Editar red social del sitio</strong>
                          </div>
                          <div class="card-body">
                              {!! Form::model($siteSocialNetwork, ['route' => ['sitio.redes.update', $siteSocialNetwork->id], 'method' => 'patch', 'autocomplete' => 'off']) !!}

                              @include('panel.site_social_networks.fields')

                              {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
         </div>
    </div>
@endsection