@extends('layouts.front')

@section('title', $event->title)

@section('metadata')
    <meta name="description" content="{!! $event->summary !!}">
    <meta name="keywords" content="Evento, {!! $event->location !!}, {!! Date::parse($event->publication_date)->setTimeZone('America/Argentina/Buenos_Aires')->format('d/m/Y h:i') !!}, Claromecó, Turismo">
    {{-- Facebook Open Graph --}}
    <meta property="og:site_name" content="{!! config('app.name') !!}" />
    <meta property="og:type" content="event" />
    <meta property="og:title" content="{!! $event->title !!}" />
    <meta property="og:description" content="{!! $event->summary !!}" />
    <meta property="og:image" content="{!! url('imagenes/noticia/' . $event->important_image) !!}" />
    <meta property="event:date" content="{!! Date::parse($event->publication_date)->setTimeZone('America/Argentina/Buenos_Aires')->format('Y-m-d') !!}" />
    <meta property="og:url" content="{!! route('single.event', $event->slug) !!}" />
@endsection

@section('css')
    <link rel="stylesheet" href="{!! asset('css/linearicons.min.css') !!}">
@endsection

@section('content')

{{-- Start post Area --}}
<div class="post-wrapper pt-100">
    {{-- Start post Area --}}
    <section class="post-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="single-page-post">
                        <img class="img-fluid" src="{!! url('imagenes/noticia/' . $event->important_image) !!}" alt="">
                        <div class="top-wrapper ">
                            <div class="row d-flex justify-content-between">
                                <h2 class="col-lg-8 col-md-12 text-uppercase">
                                    {!! $event->title !!}
                                </h2>
                            </div>
                        </div>
                        <div class="single-post-content">
                            <blockquote class="generic-blockquote">
                                {!! $event->summary !!}
                            </blockquote>

                            {!! $event->content !!}
                        </div>
                        <div class="bottom-wrapper">
                            <div class="row">
                                <div class="single-b-wrap col-md-12">
                                    <ul class="social-icons">
                                        <li><a href="https://www.facebook.com/sharer/sharer.php?u={!! route('single.event', $event->slug) !!}" title="Compartir" target="_blank" rel="noopener noreferrer"><i class="fa fa-facebook fa-2x" aria-hidden="true"></i></a></li>
                                        <li><a href="https://api.whatsapp.com/send?text=Mirá%20esté%20evento%20{!! route('single.event', $event->slug) !!}" title="Compartir" target="_blank" rel="noopener noreferrer"><i class="fa fa-whatsapp fa-2x" aria-hidden="true"></i></a></li>
                                        <li><a href="https://twitter.com/intent/tweet?text=Mirá%20esté%20evento&url={!! route('single.event', $event->slug) !!}&hashtags=[NuevoEvento]" title="Tweet" target="_blank" rel="noopener noreferrer"><i class="fa fa-twitter fa-2x" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4 sidebar-area ">
                    <div class="single_widget search_widget">
                        <div id="imaginary_container">
                            {!! Form::open(['route' => 'search.event', 'class' => 'input-group stylish-input-group', 'method' => 'GET']) !!}
                                <input type="text" class="form-control"  placeholder="Buscar..." name="search">
                                <span class="input-group-addon">
                                    <button type="submit">
                                        <span class="lnr lnr-magnifier"></span>
                                    </button>  
                                </span>
                            {!! Form::close() !!}
                        </div> 
                    </div>

                    <div class="single_widget">
                        <h3 class="text-heading">Datos del evento</h3>

                        <p><i class="fa fa-calendar"></i> {!! Date::parse($event->publication_date)->setTimeZone('America/Argentina/Buenos_Aires')->format('d M. Y') !!}</p>

                        <p><i class="fa fa-clock-o"></i> {!! Date::parse($event->publication_date)->setTimeZone('America/Argentina/Buenos_Aires')->format('H:i') !!}</p>

                        <p><i class="fa fa-map-marker"></i> {!! $event->location !!}</p>
                    </div>

                    @if ($recentEvents->count() == 3)
                    <div class="single_widget recent_widget">
                        <h4 class="text-uppercase pb-20">Últimos eventos</h4>
                        <div class="active-recent-carusel">
                            @foreach ($recentEvents as $recentEvent)
                                <div class="item">
                                    <img src="{!! url('imagenes/slider/' . $recentEvent->important_image) !!}" alt="">
                                    <p class="mt-20 title text-uppercase"><a href="{!! route('single.event', $recentEvent->slug) !!}">{!! $recentEvent->title !!}</a></p>
                                    <p>{!! \Carbon\Carbon::parse($recentEvent->publication_date)->diffForHumans() !!}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>    
    </section>
    {{-- End post Area --}}  
</div>
{{-- End post Area --}}

@endsection

@section('scripts')
    <script src="{!! asset('js/jquery.magnific-popup.min.js') !!}"></script>
    <script src="{!! asset('js/jquery.magnific-popup-es.min.js') !!}"></script>
    <script src="{!! asset('js/vendor/fluid-width-video/fluid-width-video.min.js') !!}"></script>
@endsection