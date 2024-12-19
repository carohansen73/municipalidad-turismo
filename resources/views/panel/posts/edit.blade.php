@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
          <li class="breadcrumb-item">
             <a href="{!! route('posts.index') !!}">Listado de Posts</a>
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
                              <strong>Editar Post: {!! $post->title !!}</strong>
                          </div>
                          <div class="card-body">
                              
                              @include('panel.posts.partials.carousel')

                              <br><br>

                              {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'patch', 'files' => true, 'autocomplete' => 'off']) !!}

                              @include('panel.posts.fields')

                              {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
         </div>
    </div>
@endsection