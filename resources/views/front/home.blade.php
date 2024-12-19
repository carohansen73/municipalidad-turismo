@extends('layouts.front')

@section('title', 'Inicio')

@section('metadata')
    <meta name="description" content="Portal de noticias y eventos perteneciente a Turismo Claromecó">
    <meta name="keywords" content="Turismo, Claromecó, Noticias, Eventos, Equipo, Miembros, Integrantes">
@endsection

@section('css')
    <link rel="stylesheet" href="{!! asset('css/linearicons.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/magnific-popup.min.css') !!}">
@endsection

@section('content')

    @include('front.partials.banner')

    @include('front.partials.circuits')
    
    @include('front.partials.places')

    @include('front.partials.lastest-news')

    @include('front.partials.events')

    @include('front.partials.team')
    
@endsection

@section('scripts')
    <script src="{!! asset('js/jquery.magnific-popup.min.js') !!}"></script>
    <script src="{!! asset('js/jquery.magnific-popup-es.min.js') !!}"></script>
@endsection