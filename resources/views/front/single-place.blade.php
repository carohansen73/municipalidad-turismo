@extends('layouts.front')

@section('title', $place->title)

@section('metadata')
    <meta name="description" content="{!! $place->summary !!}">
    <meta name="keywords" content="{!! $place->title !!}">
    {{-- Facebook Open Graph --}}
    <meta property="og:site_name" content="{!! config('app.name') !!}" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{!! $place->title !!}" />
    <meta property="og:description" content="{!! $place->summary !!}" />
    <meta property="og:image" content="{!! url('imagenes/noticia/' . $place->important_image) !!}" />
    <meta property="og:url" content="{!! route('single.place', $place->slug) !!}" />
@endsection

@section('css')
    <link rel="stylesheet" href="{!! asset('css/linearicons.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/magnific-popup.min.css') !!}">
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
                        <img class="img-fluid" src="{!! url('imagenes/noticia/' . $place->important_image) !!}" alt="">
                        <div class="top-wrapper ">
                            <div class="row d-flex justify-content-between">
                                <h2 class="col-lg-8 col-md-12 text-uppercase">
                                    {!! $place->title !!}
                                </h2>
                            </div>
                        </div>
                        <div class="single-post-content">
                            <blockquote class="generic-blockquote">
                                {!! $place->summary !!}
                            </blockquote>

                            {!! $place->content !!}

                            @include('front.partials.single-place-gallery')

                            <a href="{!! url('/') !!}" class="primary-btn load-more pbtn-2 text-uppercase mx-auto mt-60">Volver</a>
                        </div>
                        <div class="bottom-wrapper">
                            <div class="row">
                                <div class="single-b-wrap col-md-12">
                                    <ul class="social-icons">
                                        <li><a href="https://www.facebook.com/sharer/sharer.php?u={!! route('single.place', $place->slug) !!}" title="Compartir" target="_blank" rel="noopener noreferrer"><i class="fa fa-facebook fa-2x" aria-hidden="true"></i></a></li>
                                        <li><a href="https://api.whatsapp.com/send?text=Mirá%20esté%20lugar%20{!! route('single.place', $place->slug) !!}" title="Compartir" target="_blank" rel="noopener noreferrer"><i class="fa fa-whatsapp fa-2x" aria-hidden="true"></i></a></li>
                                        <li><a href="https://twitter.com/intent/tweet?text=Mirá%20esté%20lugar&url={!! route('single.place', $place->slug) !!}&hashtags=[{!! $place->title !!}]" title="Tweet" target="_blank" rel="noopener noreferrer"><i class="fa fa-twitter fa-2x" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
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