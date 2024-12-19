<div class="row">
    <div class="col-md-4">
        <h4>Imagen destacada</h4>
        <img src="{!! url('imagenes/medium/'. $place->important_image) !!}" alt="{!! $place->title !!}" class="img-thumbnail">
    </div>
    @if($place->galeryImages->isNotEmpty())
        <div class="col-md-4">
            <h4>Galería</h4>
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    @foreach( $place->galeryImages as $galeryImage )
                        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                    @endforeach
                </ol>
            
                <div class="carousel-inner" role="listbox">
                    @foreach( $place->galeryImages as $galeryImage )
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <img class="d-block img-fluid" src="{!! url('imagenes/galeria/' . $galeryImage->image) !!}" alt="{{ $galeryImage->image }}">
                            <div class="carousel-caption d-none d-md-block">
                                <h3></h3>
                                <p>
                                    {!! Form::open(['route' => ['place.galery.image.destroy', $galeryImage->id], 'method' => 'delete']) !!}
                                        {!! Form::button('<i class="fa fa-trash"></i> Borrar', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('¿Está seguro/a que desea eliminar la imagen de la galería?')"]) !!}
                                    {!! Form::close() !!}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    @endif
</div>