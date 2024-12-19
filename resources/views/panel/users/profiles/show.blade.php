@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
        <a href="{!! route('dashboard') !!}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Perfil</li>
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
                                <strong>Modificar mi perfil</strong>
                            </div>
                            <div class="card-body">
                                @if ($user->image != null)
                                    <img src="{!! url('imagenes/autor/' .$user->image) !!}" alt="Avatar de {!! $user->name !!}" class="img-thumbnail"><br><br>
                                @else
                                    <img src="{!! url('imagenes/autor/team1.jpg') !!}" alt="Avatar de usuario" class="img-thumbnail"><br><br>
                                @endif

                                {!! Form::open(['route' => ['profile.update', $user->id], 'method' => 'PUT', 'files' => true]) !!}

                                <div class="row">
                                    <!-- Job Field -->
                                    <div class="form-group col-sm-6">
                                        {!! Field::text('job', $user->job, ['label' => 'Trabajo / Puesto', 'autofocus']) !!}
                                    </div>

                                    <!-- Bio Field -->
                                    <div class="form-group col-sm-6">
                                        {!! Field::text('bio', $user->bio, ['label' => 'Bio / Estado']) !!}
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Password Field -->
                                    <div class="form-group col-sm-6">
                                        {!! Field::password('password', ['label' => 'Contraseña']) !!}
                                    </div>
                                
                                    <!-- Password confirmation Field -->
                                    <div class="form-group col-sm-6">
                                        {!! Field::password('password_confirmation', ['label' => 'Confirmar contraseña']) !!}
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Important Image Field -->
                                    <div class="form-group col-sm-12">
                                        {!! Field::file('image', ['label' => 'Imagen / Avatar']) !!}
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Submit Field -->
                                    <div class="form-group col-sm-12">
                                        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                                        <a href="{!! route('dashboard') !!}" class="btn btn-secondary">Cancelar</a>
                                    </div>
                                </div>

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>

@endsection