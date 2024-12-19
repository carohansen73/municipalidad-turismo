@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
         <a href="{!! route('service-providers.index') !!}">Proveedores de servicio</a>
      </li>
      <li class="breadcrumb-item active">Crear</li>
    </ol>
     <div class="container-fluid">
          <div class="animated fadeIn">
                @include('coreui-templates::common.errors')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-plus-square-o fa-lg"></i>
                                <strong>Crear nuevo post</strong>
                            </div>
                            <div class="card-body">
                                {!! Form::open(['route' => 'service-providers.store', 'files' => true, 'autocomplete' => 'off', 'enctype' => 'multipart/form-data']) !!}

                                   @include('panel.service_providers.fields')

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
           </div>
    </div>
@endsection
