@extends('layouts.front')

@section('title', $title)

@section('metadata')
    <meta name="description" content="{!! $title !!} turísticos de Claromecó">
    <meta name="keywords" content="Eventos, Todos los eventos, Claromecó, Turismo">
@endsection

@section('css')
    <link rel="stylesheet" href="{!! asset('css/linearicons.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/magnific-popup.min.css') !!}">
@endsection

@section('content')
{{-- Start top-section Area --}}
<section class="top-section-area section-gap">
    <div class="container">
        <div class="row justify-content-between align-items-center d-flex">
            <div class="col-lg-8 top-left">
                <h1 class="text-white mb-20">{!! $title !!}</h1>
                <ul>
                    <li><a href="{!! url('/') !!}">Inicio</a><span class="lnr lnr-arrow-right"></span></li>
                    <li><a href="{!! route('events') !!}">Eventos</a></li>
                </ul>
            </div>
        </div>
    </div>  
</section>
{{-- End top-section Area --}}

{{-- Start post Area --}}
<div class="post-wrapper pt-100">
    {{-- Start post Area --}}
    <section class="post-area">
        <div class="container">
            <div class="row justify-content-center d-flex">
                <div class="col-lg-8">
                    @if($events->isEmpty())
                        <div class="alert alert-info" role="alert">
                            ¡Perdón! No se han encontrado resultados para su búsqueda.
                        </div>
                    @endif
                    <div class="post-lists">
                        @foreach ($events as $event)
                        <div class="single-list flex-row d-flex">
                            <div class="thumb">
                                <div class="date">
                                    <span>{!! Date::parse($event->publication_date)->format('d') !!}</span><br>{!! Date::parse($event->publication_date)->format('M') !!}
                                </div>
                                <img src="{!! url('imagenes/ultimo-evento/' . $event->important_image) !!}" alt="">
                            </div>
                            <div class="detail">
                                <a href="{!! route('single.event', $event->slug) !!}"><h4 class="pb-20">{!! $event->title !!}</h4></a>
                                <p>
                                    {!! $event->summary !!}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <br><br><br>
                    <div class="d-flex justify-content-center">
                        {!! $events->render() !!}                
                    </div>
                </div>
                <div class="col-lg-4 sidebar-area">

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

                    @if ($recentPosts->count() == 3)
                    <div class="single_widget recent_widget">
                        <h4 class="text-uppercase pb-20">Últimas noticias</h4>
                        <div class="active-recent-carusel">
                            @foreach ($recentPosts as $recentPost)
                                <div class="item">
                                    <img src="{!! url('imagenes/slider/' . $recentPost->important_image) !!}" alt="">
                                    <p class="mt-20 title text-uppercase"><a href="{!! route('single.new', [$recentPost->category->slug, $recentPost->slug]) !!}">{!! $recentPost->title !!}</a></p>
                                    <p>{!! \Carbon\Carbon::parse($recentPost->publication_date)->diffForHumans() !!}
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
@endsection