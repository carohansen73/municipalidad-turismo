@extends('layouts.app')

@section('css')
    @include('panel.partials.css.datatables_simple')
@endsection

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Listado de Redes sociales</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
             @include('flash::message')
             <div class="row">
                 <div class="col-lg-12">
                     <div class="card">
                         <div class="card-header">
                            <i class="fa fa-align-justify"></i>
                            Redes sociales de {!! $team->name !!}
                            <a class="pull-right" href="{!! route('equipo.index') !!}" title="Listado"><i class="fa fa-caret-square-o-left fa-lg"></i></a>
                            <a class="pull-right" href="{!! route('social.network.create', $team->id) !!}" title="Crear red social"><i class="fa fa-plus-square fa-lg"></i></a>
                         </div>
                         <div class="card-body">

                            <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                            <thead>
                                <th>Red</th>
                                <th>URL</th>
                                <th>Acción</th>
                            </thead>

                            <tbody>
                                @foreach($social_networks as $social_network)
                                <tr>
                                    <td><i class="{!! $social_network->socialNetwork->icon !!}"></i> {!! $social_network->socialNetwork->name !!}</td>
                                    <td>{!! $social_network->url !!}</td>
                                    <td>
                                        {!! Form::open(['route' => ['social.network.destroy', $social_network->id], 'method' => 'delete']) !!}
                                        <div class='btn-group'>
                                            <a href="{!! route('social.network.edit', [$social_network->id]) !!}" class='btn btn-ghost-info btn-sm' title="Editar"><i class="fa fa-edit"></i></a>
                                            {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger btn-sm', 'onclick' => "return confirm('¿Está seguro/a que desea eliminar la red social?')", 'title' => 'Eliminar']) !!}
                                        </div>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>

                            </table>
                            
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

