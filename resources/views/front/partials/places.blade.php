{{-- Start category Area --}}
<section class="category-area section-gap" id="lugares">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-70 col-lg-8">
                <div class="title text-center">
                    <h1 class="mb-10">{!! $siteConfiguration->title_place !!}</h1>
                    <p>{!! $siteConfiguration->subtitle_place !!}</p>
                </div>
            </div>
        </div>						
        <div class="active-cat-carusel">
            @foreach ($places as $place)
                <div class="item single-cat">
                    <img src="{!! url('imagenes/ultima-noticia/' . $place->important_image) !!}" alt="{!! $place->title !!}">
                    <p></p>
                    <h4 class="text-center"><a href="{!! route('single.place', $place->slug) !!}">{!! $place->title !!}</a></h4>
                </div>
            @endforeach				
        </div>
        {{-- <div class="row">
            <a href="{!! route('news') !!}" class="primary-btn load-more pbtn-2 text-uppercase mx-auto mt-60">Ver más noticias</a>
        </div> --}}												
    </div>
    
    
</section>
{{-- End category Area --}}