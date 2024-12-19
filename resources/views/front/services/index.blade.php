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
<section class="top-section-area-img section-gap">
    <div class="container">
        <div class="row justify-content-start align-items-center d-flex">
            <div class="col-lg-8 top-left">
                <h1 class="text-white mb-20">{!! $title !!}</h1>
                <ul>
                    <li><a href="{!! url('/') !!}">Inicio</a><span class="lnr lnr-arrow-right"></span></li>
                    <li><a href="{!! route('servicios') !!}">Servicios</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
{{-- End top-section Area --}}

{{-- About Generic Start --}}
<div class="main-wrapper">

    {{-- Start fashion Area --}}
    <section class="fashion-area section-gap" id="services">
        <div class="container">


                @foreach ($services as $service)
                <a class="main-services" href="{!! route('servicios.ver', [$service->id]) !!}">
                    <div class="col-12 single-fashion">
                        <div class="row">
                            <div class="col-lg-6 ">
                                <img class="img-fluid" src="{!! url('storage/services/servicios/' . $service->img) !!}" alt="{!! $service->name !!}">
                            </div>
                            <div class="col-lg-6 ">
                                <h1 >{!! $service->name !!}</h1>
                                @if( $service->name == "Alojamiento")
                                <p> Descubrí donde alojarte en las diferentes localidades que forman parte del partido de tres arroyos </p>
                                @elseif( $service->name == "Gastronomía")
                                <p> Degustá la exquisita gastronomía tresarroyense  </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach


           <br><br><br>

        </div>

    </section>
    {{-- End fashion Area --}}

</div>
@endsection

@section('scripts')
    <script src="{!! asset('js/jquery.magnific-popup.min.js') !!}"></script>
    <script src="{!! asset('js/jquery.magnific-popup-es.min.js') !!}"></script>
@endsection
