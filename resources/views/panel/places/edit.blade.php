@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
          <li class="breadcrumb-item">
             <a href="{!! route('lugar.index') !!}">Lugares</a>
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
                              <strong>Editar Lugar</strong>
                          </div>

                          <div class="card-body">

                              @include('panel.places.partials.carousel')

                              {!! Form::model($place, ['route' => ['lugar.update', $place->id], 'method' => 'patch', 'files' => true, 'autocomplete' => 'off']) !!}

                              @include('panel.places.fields')

                              {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
         </div>
    </div>
@endsection