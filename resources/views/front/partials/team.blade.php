{{-- Start team Area --}}
<section class="team-area section-gap" id="equipo">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-70 col-lg-8">
                <div class="title text-center">
                    <h1 class="mb-10">{!! $siteConfiguration->title_team !!}</h1>
                    <p>{!! $siteConfiguration->subtitle_team !!}</p>
                </div>
            </div>
        </div>						
        <div class="row justify-content-center d-flex align-items-center">
            <div class="col-lg-6 team-left">
                {!! $siteConfiguration->description_team !!}
            </div>
            <div class="col-lg-6 team-right d-flex justify-content-center">
                <div class="row active-team-carusel">
                    @foreach ($members as $member)
                        <div class="single-team">
                            <div class="thumb">
                                <img class="img-fluid" src="{!! url('imagenes/equipo/' . $member->important_image) !!}" alt="">
                                <div class="align-items-center justify-content-center d-flex">
                                    @foreach ($member->socialNetworks as $socialNetwork)
                                        @if ($socialNetwork->name == 'Correo')
                                            <a href="mailto:{!! $socialNetwork->pivot->url !!}"><i class="{!! $socialNetwork->icon !!}"></i></a>
                                        @else
                                            <a href="{!! $socialNetwork->pivot->url !!}"  target="_blank"><i class="{!! $socialNetwork->icon !!}"></i></a>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="meta-text mt-30 text-center">
                                <h4>{!! $member->name !!}</h4>
                                <p>{!! $member->job !!}</p>									    	
                            </div>
                        </div>
                    @endforeach													
                </div>
            </div>
        </div>
    </div>	
</section>
{{-- End team Area --}}