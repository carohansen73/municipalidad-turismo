@extends('layouts.app')

@section('css')
    @include('panel.partials.css.datatables_simple')
@endsection

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Listado de Categorías</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
             @include('flash::message')
             <div class="row">
                 <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i>
                            Categorías
                            <a class="pull-right" href="{!! route('posts.categorias.create') !!}"><i class="fa fa-plus-square fa-lg" title="Crear categoría"></i></a>
                        </div>
                        <div class="card-body">
                            @include('panel.post_categories.table')
                            <div class="pull-right mr-3">
                                        
                            </div>
                        </div>
                     </div>
                  </div>
             </div>
         </div>
    </div>
@endsection

@section('scripts')
    @include('panel.partials.scripts.datatables_simple')
@endsection

