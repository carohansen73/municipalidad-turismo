{{-- Start travel Area --}}
<section class="travel-area section-gap" id="eventos">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-70 col-lg-8">
                <div class="title text-center">
                    <h1 class="mb-10">{!! $siteConfiguration->title_events !!}</h1>
                    <p>{!! $siteConfiguration->subtitle_events !!}</p>
                </div>
            </div>
        </div>						
        <div class="row">
            <div class="col-lg-6 travel-left">
                <div class="single-travel media pb-70">
                    @if ($event_1 != null)
                        <img class="img-fluid d-flex  mr-3" src="{!! url('imagenes/ultimo-evento/' . $event_1->important_image) !!}" alt="">
                        <div class="dates">
                            <span>{!! Date::parse($event_1->publication_date)->format('d') !!}</span>
                            <p>{!! Date::parse($event_1->publication_date)->format('M') !!}</p>
                        </div>
                        <div class="media-body align-self-center">
                            <h4 class="mt-0"><a href="{!! route('single.event', $event_1->slug) !!}">{!! $event_1->title !!}</a></h4>
                            <p>{!! $event_1->summary !!}</p>
                        </div>
                    @endif
                </div>
                <div class="single-travel media">
                    @if ($event_3 != null)
                        <img class="img-fluid d-flex  mr-3" src="{!! url('imagenes/ultimo-evento/' . $event_3->important_image) !!}" alt="">
                        <div class="dates">
                            <span>{!! Date::parse($event_3->publication_date)->format('d') !!}</span>
                            <p>{!! Date::parse($event_3->publication_date)->format('M') !!}</p>
                        </div>							  
                        <div class="media-body align-self-center">
                        <h4 class="mt-0"><a href="{!! route('single.event', $event_3->slug) !!}">{!! $event_3->title !!}</a></h4>
                        <p>{!! $event_3->summary !!}</p>
                        </div>
                    @endif
                </div>														
            </div>
            <div class="col-lg-6 travel-right">
                <div class="single-travel media pb-70">
                    @if ($event_2 != null)
                        <img class="img-fluid d-flex  mr-3" src="{!! url('imagenes/ultimo-evento/' . $event_2->important_image) !!}" alt="">
                        <div class="dates">
                            <span>{!! Date::parse($event_2->publication_date)->format('d') !!}</span>
                            <p>{!! Date::parse($event_2->publication_date)->format('M') !!}</p>
                        </div>							  
                        <div class="media-body align-self-center">
                        <h4 class="mt-0"><a href="{!! route('single.event', $event_2->slug) !!}">{!! $event_2->title !!}</a></h4>
                        <p>{!! $event_2->summary !!}</p>
                        </div>
                    @endif
                </div>
                <div class="single-travel media">
                    @if ($event_4 != null)
                        <img class="img-fluid d-flex  mr-3" src="{!! url('imagenes/ultimo-evento/' . $event_4->important_image) !!}" alt="">
                        <div class="dates">
                            <span>{!! Date::parse($event_4->publication_date)->format('d') !!}</span>
                            <p>{!! Date::parse($event_4->publication_date)->format('M') !!}</p>
                        </div>							  
                        <div class="media-body align-self-center">
                            <h4 class="mt-0"><a href="{!! route('single.event', $event_4->slug) !!}">{!! $event_4->title !!}</a></h4>
                            <p>{!! $event_3->summary !!}</p>
                        </div>
                    @endif
                </div>								
            </div>
            <a href="{!! route('events') !!}" class="primary-btn load-more pbtn-2 text-uppercase mx-auto mt-60">Ver más eventos</a>		
        </div>
    </div>					
</section>
{{-- End travel Area --}}