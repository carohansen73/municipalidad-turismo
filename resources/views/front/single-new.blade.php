@extends('layouts.front')

@section('title', $post->title)

@section('metadata')
    <meta name="description" content="{!! $post->summary !!}">
    <meta name="keywords" content="Noticia, {!! $post->category->name !!}, @foreach ($post->tags as $tag){!! $tag->name !!}, @endforeach, Claromecó, Turismo">
    {{-- Facebook Open Graph --}}
    <meta property="og:site_name" content="{!! config('app.name') !!}" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{!! $post->title !!}" />
    <meta property="og:description" content="{!! $post->summary !!}" />
    <meta property="og:image" content="{!! url('imagenes/noticia/' . $post->important_image) !!}" />
    <meta property="og:url" content="{!! route('single.new', [$post->category->slug, $post->slug]) !!}" />
@endsection

@section('css')
    <link rel="stylesheet" href="{!! asset('css/linearicons.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/magnific-popup.min.css') !!}">
    {{-- <link rel="stylesheet" href="{!! asset('css/video_iframe.min.css') !!}"> --}}
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
                        <img class="img-fluid" src="{!! url('imagenes/noticia/' . $post->important_image) !!}" alt="">
                        <div class="top-wrapper ">
                            <div class="row d-flex justify-content-between">
                                <h2 class="col-lg-8 col-md-12 text-uppercase">
                                    {!! $post->title !!}
                                </h2>
                                <div class="col-lg-4 col-md-12 right-side d-flex justify-content-end">
                                    <div class="desc">
                                       <h2><i class="fa fa-folder-open"></i> {!! $post->category->name !!}</h2>
                                        <h3>{!! Date::parse($post->publication_date)->setTimeZone('America/Argentina/Buenos_Aires')->format('d M. Y') !!} · {!! Date::parse($post->publication_date)->setTimeZone('America/Argentina/Buenos_Aires')->format('H:i') !!}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tags">
                            <ul>
                                @foreach ($post->tags as $tag)
                                    <li><a href="{!! route('tag.news', $tag->slug) !!}">{!! $tag->name !!}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="single-post-content">
                            <blockquote class="generic-blockquote">
                                {!! $post->summary !!}
                            </blockquote>

                            {!! $post->content !!}

                            @include('front.partials.single-new-gallery')

                        </div>
                        <div class="bottom-wrapper">
                            <div class="row">
                                <div class="single-b-wrap col-md-12">
                                    <ul class="social-icons">
                                        <li><a href="https://www.facebook.com/sharer/sharer.php?u={!! route('single.new', [$post->category->slug, $post->slug]) !!}" title="Compartir" target="_blank" rel="noopener noreferrer"><i class="fa fa-facebook fa-2x" aria-hidden="true"></i></a></li>
                                        <li><a href="https://api.whatsapp.com/send?text=Mirá%20está%20noticia%20{!! route('single.new', [$post->category->slug, $post->slug]) !!}" title="Compartir" target="_blank" rel="noopener noreferrer"><i class="fa fa-whatsapp fa-2x" aria-hidden="true"></i></a></li>
                                        <li><a href="https://twitter.com/intent/tweet?text=Mirá%20está%20noticia&url={!! route('single.new', [$post->category->slug, $post->slug]) !!}&hashtags=[@foreach ($post->tags as $tag) {!! $tag->name !!} @endforeach]" title="Tweet" target="_blank" rel="noopener noreferrer"><i class="fa fa-twitter fa-2x" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        {{-- Start nav Area --}}
                        <section class="nav-area pt-50 pb-100">
                            <div class="container">
                                <div class="row justify-content-between">
                                    @if($prev_post != null)
                                    <div class="col-sm-6 nav-left justify-content-start d-flex">
                                        <div class="thumb">
                                            <img src="{!! url('imagenes/noticia-previa/' . $prev_post->important_image) !!}" alt="Imagen de la noticia {!! $prev_post->title !!}">
                                        </div>
                                        <div class="details">
                                            <p>Anterior noticia</p>
                                            <h4 class="text-uppercase"><a href="{!! route('single.new', [$prev_post->category->slug, $prev_post->slug]) !!}" aria-label="Anterior noticia noticia">{!! $prev_post->title !!}</a></h4>
                                        </div>
                                    </div>
                                    @endif
                                    @if($next_post != null)
                                    <div class="col-sm-6 nav-right justify-content-end d-flex">
                                        <div class="details">
                                            <p>Siguiente noticia</p>
                                            <h4 class="text-uppercase"><a href="{!! route('single.new', [$next_post->category->slug, $next_post->slug]) !!}" aria-label="Siguiente noticia">{!! $next_post->title !!}</a></h4>
                                        </div>           
                                        <div class="thumb">
                                            <img src="{!! url('imagenes/noticia-proxima/' . $next_post->important_image) !!}" alt="Imagen de la noticia {!! $next_post->title !!}">
                                        </div>                    
                                    </div>
                                    @endif
                                </div>
                            </div>    
                        </section>
                        {{-- End nav Area --}}                        
                    </div>
                </div>
                <div class="col-lg-4 sidebar-area ">
                    <div class="single_widget search_widget">
                        <div id="imaginary_container">
                            {!! Form::open(['route' => 'search.new', 'class' => 'input-group stylish-input-group', 'method' => 'GET']) !!}
                                <input type="text" class="form-control"  placeholder="Buscar..." name="search">
                                <span class="input-group-addon">
                                    <button type="submit" title="Buscar">
                                        <span class="lnr lnr-magnifier"></span>
                                    </button>  
                                </span>
                            {!! Form::close() !!}
                        </div> 
                    </div>

                    @if ($post->signature_author)
                    <div class="single_widget about_widget">
                        @if ($post->user->image != null)
                            <img src="{!! url('imagenes/autor/' . $post->user->image) !!}" alt="Avatar de {!! $post->user->name !!} {!! $post->user->lastname !!}" class="rounded-circle">
                        @else
                            <img src="{!! url('imagenes/autor/team1.jpg') !!}" alt="" class="rounded-circle">
                        @endif
                        <h2 class="text-uppercase">{!! $post->user->name !!} {!! $post->user->lastname !!}</h2>
                        <p>
                            {!! $post->user->bio !!}
                        </p>
                    </div>
                    @endif

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

                    <div class="single_widget cat_widget">
                        <h4 class="text-uppercase pb-20">Categorías</h4>
                        <ul>
                            @foreach ($categories as $category)
                                <li>
                                    <a href="{!! route('category.news', $category->slug) !!}" aria-label="Categoría {!! $category->name !!}">{!! $category->name !!} <span>{!! $category->postPublished->count() !!}</span></a>
                                </li>
                            @endforeach
                        </ul>
                    </div> 

                    <div class="single_widget tag_widget">
                        <h4 class="text-uppercase pb-20">Palabras claves</h4>
                        <ul>
                            @foreach ($tags as $tag)
                                <li><a href="{!! route('tag.news', $tag->slug) !!}">{!! $tag->name !!}</a></li>
                            @endforeach
                        </ul>
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