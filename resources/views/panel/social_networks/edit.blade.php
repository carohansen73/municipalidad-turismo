@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
          <li class="breadcrumb-item">
             <a href="{!! route('redes.index') !!}">Social Network</a>
          </li>
          <li class="breadcrumb-item active">Edit</li>
        </ol>
    <div class="container-fluid">
         <div class="animated fadeIn">
             @include('coreui-templates::common.errors')
             <div class="row">
                 <div class="col-lg-12">
                      <div class="card">
                          <div class="card-header">
                              <i class="fa fa-edit fa-lg"></i>
                              <strong>Edit Social Network</strong>
                          </div>
                          <div class="card-body">
                              {!! Form::model($socialNetwork, ['route' => ['redes.update', $socialNetwork->id], 'method' => 'patch', 'autocomplete' => 'off']) !!}

                              @include('panel.social_networks.fields')

                              {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
         </div>
    </div>
@endsection