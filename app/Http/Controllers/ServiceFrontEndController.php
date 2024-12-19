<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateServiceProviderRequest;
use App\Http\Requests\UpdateServiceProviderRequest;
use App\Repositories\ServiceProviderRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use App\Models\ServiceProvider;
use App\Models\Service;
use App\Models\ServicePhotoGallery;
use App\Models\ServiceAmenities;
use App\Models\ServiceProviderAmenities;
use Image;

class ServiceFrontEndController extends Controller
{


    public function __construct()
    {

    }

    /**
     * Display a listing of the Service.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $services = Service::all();

        $title = 'Descubrí Tres Arroyos';
        return view('front.services.index')
            ->with('title', $title)
            ->with('services', $services);
    }


    public function showServiceProviders($serviceId)
    {
        $service = Service::where('id', $serviceId)->firstOrFail();
        // $serviceProviders = ServiceProvider::where('service_id', $serviceId)->orderBy('title')->with('images')->take(1)->get();
        $serviceProviders = ServiceProvider::where('service_id', $serviceId)->with(['lastImage'])->get();

        $serviceName = $service->name;

        // $post = Post::where('slug', $new_slug)->where('publish', 1)->firstOrFail();
        // $prev_post = $this->previousPost($post);
        // $next_post = $this->nextPost($post);

        // $categories = PostCategory::where('publish', 1)->get();
        // $tags = PostTag::where('publish', 1)->get();
        // $recentPosts = Post::where('publish', 1)->orderBy('publication_date', 'DESC')->get()->take(3);

        // return view('front.single-new', compact('post', 'prev_post', 'next_post', 'categories', 'tags', 'recentPosts'));

        $title = 'Encontrá tu próximo '.$serviceName;
        return view('front.services.show-service-providers', compact('serviceName', 'title', 'serviceProviders'));
    }

    public function showSingleProvider($providerId){

        $serviceProvider = ServiceProvider::where('id', $providerId)->with(['lastImage'])->firstOrFail();
        $images = ServicePhotoGallery::where('service_provider_id',  $providerId)->get();
        $amenities = ServiceAmenities::whereIn('id', ServiceProviderAmenities::where('service_provider_id', $providerId)->pluck('amenities_id'))->get();
        $service = Service::where('id', $serviceProvider->service_id)->firstOrFail();
        $serviceName = $service->name;

        $suggestions = ServiceProvider::where('location_city', $serviceProvider->location_city)
        ->with('lastImage')->take(2)->get();


        return view('front.services.show-provider', compact( 'serviceProvider', 'images', 'amenities', 'serviceName', 'suggestions'));
    }
}
