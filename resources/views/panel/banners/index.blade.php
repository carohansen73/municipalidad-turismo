@extends('layouts.app')

@section('css')
    @include('panel.partials.css.datatables_simple')
@endsection

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Banner</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
             @include('flash::message')
             <div class="row">
                 <div class="col-lg-12">
                     <div class="card">
                         <div class="card-header">
                             <i class="fa fa-align-justify"></i>
                             Banner
                             <a class="pull-right" href="{!! route('banners.create') !!}" title="Crear"><i class="fa fa-plus-square fa-lg"></i></a>
                         </div>
                         <div class="card-body">
                            @include('panel.banners.table')
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

