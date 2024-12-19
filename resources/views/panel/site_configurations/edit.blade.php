@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
          <li class="breadcrumb-item">
             <a href="{!! route('dashboard') !!}">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Editar</li>
        </ol>
    <div class="container-fluid">
         <div class="animated fadeIn">
             @include('coreui-templates::common.errors')
             @include('flash::message')
             <div class="row">
                 <div class="col-lg-12">
                      <div class="card">
                          <div class="card-header">
                              <i class="fa fa-edit fa-lg"></i>
                              <strong>Editar configuración del sitio</strong>
                          </div>
                          <div class="card-body">
                              {!! Form::model($siteConfiguration, ['route' => ['siteConfigurations.update', $siteConfiguration->id], 'method' => 'patch', 'autocomplete' => 'off', 'files' => true]) !!}

                              @include('panel.site_configurations.fields')

                              {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
         </div>
    </div>
@endsection