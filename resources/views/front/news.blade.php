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
            @if($posts->isEmpty())
                <div class="alert alert-info" role="alert">
                    ¡Perdón! No se han encontrado resultados para su búsqueda.
                </div>
            @endif					
            <div class="row">
                @foreach ($posts as $post)
                    <div class="col-lg-3 col-md-6 single-fashion">
                        <img class="img-fluid" src="{!! url('imagenes/ultima-noticia/' . $post->important_image) !!}" alt="{!! $post->title !!}">
                        <p class="date">{!! Date::parse($post->publication_date)->format('d M. Y') !!}</p>
                        <h4><a href="{!! route('single.new', [$post->category->slug, $post->slug]) !!}">{!! $post->title !!}</a></h4>
                        <p>
                            {!! str_limit($post->summary, 57, ' ...') !!}
                        </p>
                    </div>
                @endforeach						
            </div>
            
           <br><br><br>
            <div class="d-flex justify-content-center">
                {!! $posts->render() !!}                
            </div>
        </div>
        
    </section>
    {{-- End fashion Area --}}

</div>
@endsection

@section('scripts')
    <script src="{!! asset('js/jquery.magnific-popup.min.js') !!}"></script>
    <script src="{!! asset('js/jquery.magnific-popup-es.min.js') !!}"></script>
@endsection