@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
          <li class="breadcrumb-item">
             <a href="{!! route('posts.categorias.index') !!}">Listado de Categorías</a>
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
                              <strong>Editar categoría: {!! $postCategory->name !!}</strong>
                          </div>
                          <div class="card-body">
                              {!! Form::model($postCategory, ['route' => ['posts.categorias.update', $postCategory->id], 'method' => 'patch', 'autocomplete' => 'off']) !!}

                              @include('panel.post_categories.fields')

                              {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
         </div>
    </div>
@endsection