@extends('layouts.app')

@section('css')
    @include('panel.partials.css.datatables_simple')
@endsection

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">{!! $title !!}</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
             @include('flash::message')
             <div class="row">
                 <div class="col-lg-12">
                     <div class="card">
                         <div class="card-header">
                             @if (Request::is('acontecimientos/papelera*'))
                                <i class="fa fa-trash"></i>
                             @else
                                <i class="fa fa-align-justify"></i>
                             @endif
                             Acontecimientos
                                
                             @if (Request::is('acontecimientos/papelera*'))
                                <a class="pull-right" href="{!! route('acontecimientos.index') !!}" title="Listado"><i class="fa fa-caret-square-o-left fa-lg"></i></a>
                             @else
                                <a class="pull-right" href="{!! route('events.trash') !!}" title="Papelera"><i class="fa fa-trash fa-lg"></i></a>
                             @endif
                             <a class="pull-right" href="{!! route('acontecimientos.create') !!}"><i class="fa fa-plus-square fa-lg"></i></a>
                         </div>
                         <div class="card-body">
                             @include('panel.events.table')
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
    @include('panel.partials.scripts.datatables_date_order')
@endsection

