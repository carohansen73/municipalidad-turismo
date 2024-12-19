{{-- Start category Area --}}
<section class="category-area section-gap" id="circuitos">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-70 col-lg-8">
                <div class="title text-center">
                    <h1 class="">Circuitos</h1>
                    {{--<p>{!! $siteConfiguration->subtitle_place !!}</p>--}}
                </div>
            </div>
        </div>						
        <div class="active-cat-carusel" id="">
            @foreach ($circuits as $circuit)
                <div class="item single-cat">
                    <img src="{!! url('imagenes/ultima-noticia/' . $circuit->important_image) !!}" alt="{!! $circuit->title !!}">
                    <p></p>
                    <h4 class="text-center"><a href="{!! route('single.place', $circuit->slug) !!}">{!! $circuit->title !!}</a></h4>
                </div>
            @endforeach				
        </div>
    </div>
</section>
{{-- End category Area --}}