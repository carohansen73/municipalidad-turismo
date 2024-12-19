@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
          <li class="breadcrumb-item">
             <a href="{!! route('banners.index') !!}">Banner</a>
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
                              <strong>Editar Banner</strong>
                          </div>
                          <div class="card-body">
                              <img src="{!! url('imagenes/medium/'. $banner->important_image) !!}" alt="{!! $banner->title !!}" class="img-thumbnail"><br><br>

                              {!! Form::model($banner, ['route' => ['banners.update', $banner->id], 'method' => 'patch', 'files' => true, 'autocomplete' => 'off']) !!}

                              @include('panel.banners.fields')

                              {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
         </div>
    </div>
@endsection