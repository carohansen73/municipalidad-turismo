@extends('layouts.front')

@section('title', $title)

@section('metadata')
    <meta name="description" content="{!! $title !!} turísticas de Claromecó">
    <meta name="keywords" content="Noticias, Todas las noticias, Claromecó, Turismo">
@endsection

@section('css')
    <link rel="stylesheet" href="{!! asset('css/linearicons.min.css') !!}">
@endsection

@section('content')
{{-- Start top-section Area --}}
<section class="top-section-area section-gap">
    <div class="container">
        <div class="row justify-content-start align-items-center d-flex">
            <div class="col-lg-8 top-left">
                <h1 class="text-white mb-20">{!! $title !!}</h1>
                <ul>
                    <li><a href="{!! url('/') !!}">Inicio</a><span class="lnr lnr-arrow-right"></span></li>
                    <li><a href="{!! route('news') !!}">Noticias</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
{{-- End top-section Area --}}

{{-- About Generic Start --}}
<div class="main-wrapper">

    {{-- Start fashion Area --}}
    <section class="fashion-area section-gap" id="fashion">
        <div class="container">
            @if($serviceProviders->isEmpty())
                <div class="alert alert-info" role="alert">
                    ¡Perdón! No se han encontrado resultados para su búsqueda.
                </div>
            @endif
            <div class="row">
                @foreach ($serviceProviders as $sp)
                    <div class="col-lg-4 col-md-6 single-fashion">
                        <a href="{!! route('proveedor.ver', [$sp->id]) !!}">
                            @if($sp->lastImage)
                            <div class="list-prov-container-img">
                                <img class="img-fluid" src="{!! url('storage/services/alojamiento/' . $sp->lastImage->photo_url) !!}" alt="{!! $sp->title !!}">
                            </div>

                            @endif
                            <p class="date">{!!$sp->title !!}</p>
                            <h4>{!! $sp->title !!}</h4>
                            <p>
                                {!! str_limit($sp->description, 57, ' ...') !!}
                            </p>
                        </a>
                    </div>
                @endforeach
            </div>

           <br><br><br>
            {{-- <div class="d-flex justify-content-center">
                {!! $posts->render() !!}
            </div> --}}
        </div>

    </section>
    {{-- End fashion Area --}}

</div>
@endsection

@section('scripts')
    <script src="{!! asset('js/jquery.magnific-popup.min.js') !!}"></script>
    <script src="{!! asset('js/jquery.magnific-popup-es.min.js') !!}"></script>
@endsection
