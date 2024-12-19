@extends('layouts.app')

@section('content')
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
             <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="card text-white bg-primary">
                        <div class="card-body pb-0">
                            <i class="fa fa-map-signs p-0 float-right fa-3x"></i>

                            <div class="text-value">{!! $places !!}</div>
                            <div>Lugares totales</div>
                        </div>
                        <div class="chart-wrapper mt-3 mx-3" style="height:30px;">
                        </div>
                    </div>
                </div>
                <!-- /.col-->
                <div class="col-sm-6 col-lg-3">
                    <div class="card text-white bg-info">
                        <div class="card-body pb-0">
                            <i class="fa fa-newspaper-o p-0 float-right fa-3x"></i>

                            <div class="text-value">{!! $posts !!}</div>
                            <div>Posts totales</div>
                        </div>
                        <div class="chart-wrapper mt-3 mx-3" style="height:30px;">
                        </div>
                    </div>
                </div>
                <!-- /.col-->
                <div class="col-sm-6 col-lg-3">
                    <div class="card text-white bg-primary">
                        <div class="card-body pb-0">
                            <i class="fa fa-calendar p-0 float-right fa-3x"></i>

                            <div class="text-value">{!! $events !!}</div>
                            <div>Acontecimientos totales</div>
                        </div>
                        <div class="chart-wrapper mt-3 mx-3" style="height:30px;">
                        </div>
                    </div>
                </div>
                <!-- /.col-->
                <div class="col-sm-6 col-lg-3">
                    <div class="card text-white bg-info">
                        <div class="card-body pb-0">
                            <i class="fa fa-users p-0 float-right fa-3x"></i>
                            
                            <div class="text-value">{!! $teams !!}</div>
                            <div>Miembros en el equipo</div>
                        </div>
                        <div class="chart-wrapper mt-3 mx-3" style="height:30px;">
                        </div>
                    </div>
                </div>
                <!-- /.col-->
            </div>
        </div>
    </div>
@endsection