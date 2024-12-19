<!-- Start fashion Area -->
<section class="fashion-area section-gap" id="noticias">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-70 col-lg-8">
                <div class="title text-center">
                    <h1 class="mb-10">{!! $siteConfiguration->title_news !!}</h1>
                    <p>{!! $siteConfiguration->subtitle_news !!}</p>
                </div>
            </div>
        </div>					
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
            @if ($posts->count() >= 4)	
                <a href="{!! route('news') !!}" class="primary-btn load-more pbtn-2 text-uppercase mx-auto mt-60">Ver más noticias</a>
            @endif						
        </div>
    </div>	
</section>
<!-- End fashion Area -->