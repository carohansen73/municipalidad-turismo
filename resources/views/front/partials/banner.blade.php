@if ($banner != null)
{{-- start banner Area --}}
<section class="banner-area relative" id="inicio" data-parallax="scroll" data-image-src="{!! url('imagenes/banner/' . $banner->important_image) !!}">
    <div class="overlay-bg overlay"></div>
    <div class="container">
        <div class="row fullscreen">
            <div class="banner-content d-flex align-items-center col-lg-12 col-md-12">
                <h1>
                    {!! $banner->title !!}
                </h1>
            </div>	
            <div class="head-bottom-meta d-flex justify-content-between align-items-end col-lg-12">
                <div class="col-lg-6 flex-row d-flex meta-left no-padding">
                </div>
                <div class="col-lg-6 flex-row d-flex meta-right no-padding justify-content-end">
                </div>
            </div>												
        </div>
    </div>
</section>
{{-- End banner Area --}}
@endif