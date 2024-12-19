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
use App\Models\Post;
use App\Models\ServiceAmenities;
use Image;

class ServiceProviderController extends AppBaseController
{
    /** @var  ServiceProviderRepository */
    private $serviceProviderRepository;

    public function __construct(ServiceProviderRepository $serviceProviderRepo)
    {
        $this->serviceProviderRepository = $serviceProviderRepo;
    }

    /**
     * Display a listing of the Event.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $serviceProviders = $this->serviceProviderRepository->all();

        $title = 'Listado de proveedores de servicios';
        return view('panel.service_providers.index')
            ->with('title', $title)
            ->with('serviceProviders', $serviceProviders);
    }

    /**
     * Show the form for creating a new Event.
     *
     * @return Response
     */
    public function create()
    {
        $services = Service::pluck('name', 'id')->all();
        $amenities = ServiceAmenities::all();

        return view('panel.service_providers.create')->with('services', $services)->with('amenities', $amenities);
    }



    /**
     * Store a newly created Event in storage.
     *
     * @param CreateEventRequest $request
     *
     * @return Response
     */
    public function store(CreateEventRequest $request)
    {
        $event = new Event($request->all());
        if ($request->hasFile('important_image')) {
            $event->important_image = $this->uploadFileImportantImage($request);
        }
        $event->user_id = \Auth::user()->id;
        $event->save();
        Flash::success('Acontecimiento guardado con éxito.');
        return redirect(route('acontecimientos.index'));
    }

    /**
     * Display the specified Event.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $event = $this->eventRepository->find($id);

        if (empty($event)) {
            Flash::error('Evento no encontrado.');

            return redirect(route('acontecimientosindex'));
        }

        return view('panel.events.show')->with('event', $event);
    }

    /**
     * Show the form for editing the specified Event.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $event = $this->eventRepository->find($id);

        if (empty($event)) {
            Flash::error('Evento no encontrado.');

            return redirect(route('acontecimientosindex'));
        }

        return view('panel.events.edit')->with('event', $event);
    }

    /**
     * Update the specified Event in storage.
     *
     * @param int $id
     * @param UpdateEventRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEventRequest $request)
    {
        $event = Event::findOrFail($id);
        if (empty($event)) {
            Flash::error('Acontecimiento no encontrado');
            return redirect(route('acontecimientos.index'));
        }
        if ($request->hasFile('important_image')) {
            $this->deleteFileImportantImage($event);
            $event->important_image = $this->uploadFileImportantImage($request);
        }
        $event->title = $request->title;
        $event->summary = $request->summary;
        $event->publication_date = $request->publication_date;
        $event->location = $request->location;
        $event->content = $request->content;
        $event->user_id = \Auth::user()->id;
        $event->publish = $request->publish;
        $event->save();

        Flash::success('Acontecimiento actualizado con éxito.');
        return redirect(route('acontecimientos.index'));
    }

    /**
     * Remove the specified Event from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $event = $this->eventRepository->find($id);

        if (empty($event)) {
            Flash::error('Evento no encontrado.');

            return redirect(route('acontecimientos.index'));
        }

        $this->eventRepository->delete($id);

        Flash::success('Evento enviado a la papelera con éxito.');

        return redirect(route('acontecimientos.index'));
    }

    public function uploadFileImportantImage($request)
    {
        // get file extension
        $extension = $request->file('important_image')->getClientOriginalExtension();
        // filename to store
        $filenametostore = str_slug($request->title . '-' . time()) . '.' . $extension;
        // Upload File
        $request->file('important_image')->storeAs('public/events', $filenametostore);
        // Resize image here
        $important_imagepath = public_path('storage/events/' . $filenametostore);
        // create a cached image and set a lifetime and return as object instead of string
        $img = Image::cache(function ($important_image) use ($filenametostore) {
            $important_image->make('storage/events/' . $filenametostore)->fit(750, 450);
        }, 10, true);
        $img->save($important_imagepath);
        return $filenametostore;
    }

    public function deleteFileImportantImage($event)
    {
        if (\File::exists(public_path() . '/storage/events/' . $event->important_image)) {
            \File::delete(public_path() . '/storage/events/' . $event->important_image);
        } else {
            \Alert::message('¡La imagen destacada no existe!', 'danger');
        }
    }


    /*
    *   Busco amenities por tipo de servicio (uso con ajax) en create y update
    */
    public function getAmenitiesByService(Request $request)
    {
        $serviceId = $request->input('service_id');
        $amenities = ServiceAmenities::where('service_id', $serviceId)->get();

        return response()->json($amenities);
    }

}
