@if($post->galeryImages->isNotEmpty())
    <div class="section-top-border">
        <h4>Galería de imágenes</h4>
        <div class="row gallery-item">
            @foreach ($post->galeryImages as $galeryImage)
                <div class="col-md-4">
                    <a href="{!! url('imagenes/galeria/' . $galeryImage->image) !!}" class="img-pop-up" aria-label="Foto de la galería {!! $loop->index !!}"><div class="single-gallery-image" style="background: url({!! url('imagenes/galeria/' . $galeryImage->image) !!});"></div></a>
                </div>
            @endforeach
        </div>
    </div>
@endif