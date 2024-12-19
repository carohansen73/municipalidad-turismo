{{-- start footer Area --}}		
<footer class="footer-area section-gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="single-footer-widget">
                    <h6>Links de interés</h6>
                    <ul class="footer-nav">
                        <li><a href="https://www.tresarroyos.gov.ar/" target="_blank" rel="noopener noreferrer">Municipalidad de Tres Arroyos</a></li>
                        <li><a href=" https://drive.google.com/open?id=1ZsQAhmTdcyqn7jtfJh6a8a7tCRO87Hkb" target="_blank" rel="noopener noreferrer">Descargas</a></li>
                        <li><a href="http://mapaturismo.tresarroyos.gov.ar/" target="_blank" rel="noopener noreferrer">Mapa turístico</a></li>
                        <li><a href="tel:+5492983458996" target="_blank" rel="noopener noreferrer">Tel: (2983) 458996</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-12">
                <div class="single-footer-widget mail-chimp">
                    <h6 class="mb-20">Últimas fotos</h6>
                    <ul class="instafeed d-flex flex-wrap">
                        @foreach ($post_galery_images as $galery)
                            @if($galery->post != null)
                                <li><a href="{!! route('single.new', [$galery->post->category->slug, $galery->post->slug]) !!}" aria-label="Imagen de la noticia {!! $galery->post->title !!}"><img src="{!! url('imagenes/ultimas-fotos/' . $galery->image) !!}" alt="Imagen de la noticia {!! $galery->post->title !!}"></a></li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>						
        </div>

        <div class="row footer-bottom d-flex justify-content-between">
            {{-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --}}
            <p class="col-lg-8 col-sm-12 footer-text">Copyright &copy;<script>document.write(new Date().getFullYear());</script> Todos los derechos reservados | Dirección de Turismo</p>
            {{-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --}}
            <div class="col-lg-4 col-sm-12 footer-social">
                @foreach ($site_social_networks as $site_social_network)
                    
                    @if ($site_social_network->socialNetwork->name == 'Correo')
                        <a href="mailto:{!! $site_social_network->url !!}"><i class="{!! $site_social_network->socialNetwork->icon !!}"></i></a>
                    @else
                        <a href="{!! $site_social_network->url !!}" target="_blank" rel="noopener noreferrer"><i class="{!! $site_social_network->socialNetwork->icon !!}"></i></a>
                    @endif

                @endforeach
            </div>
        </div>
    </div>
</footer>
{{-- End footer Area --}}