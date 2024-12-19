<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Repositories\EventRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use App\Models\Event;
use App\Models\Post;
use Image;

class EventController extends AppBaseController
{
    /** @var  EventRepository */
    private $eventRepository;

    public function __construct(EventRepository $eventRepo)
    {
        $this->eventRepository = $eventRepo;
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
        $events = $this->eventRepository->all();

        $title = 'Listado de acontecimientos';
        return view('panel.events.index')
            ->with('title', $title)
            ->with('events', $events);
    }

    /**
     * Show the form for creating a new Event.
     *
     * @return Response
     */
    public function create()
    {
        return view('panel.events.create');
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

    public function events()
    {
        $events = Event::where('publish', 1)->orderBy('publication_date', 'DESC')->paginate(12);
        $title = 'Todos los eventos';

        $recentPosts = Post::where('publish', 1)->orderBy('publication_date', 'DESC')->get()->take(3);

        return view('front.events', compact('events', 'title', 'recentPosts'));
    }

    public function searchEvent(Request $request)
    {
        $search = $request->search;

        $events = Event::search($search)->where('publish', 1)->orderBy('publication_date', 'DESC')->paginate(12);
        $title = 'Resultados de la busqueda: ' . $search;

        $recentPosts = Post::where('publish', 1)->orderBy('publication_date', 'DESC')->get()->take(3);

        return view('front.events', compact('events', 'title', 'recentPosts'));
    }

    public function singleEvent($event_slug)
    {
        $event = Event::where('publish', 1)->whereSlug($event_slug)->get()->first();

        $recentEvents = Event::where('publish', 1)->orderBy('publication_date', 'DESC')->get()->take(3);

        return view('front.single-event', compact('event', 'recentEvents'));
    }

    /**
     * Get the trash can with all the deleted posts
     */
    public function trash()
    {
        $events = Event::onlyTrashed()->get();
        $title = 'Acontecimientos en papelera';
        return view('panel.events.index')
            ->with('events', $events)
            ->with('title', $title);
    }

    /**
     * Remove the selected post permanently
     */
    public function trashDelete($id)
    {
        try {
            $event = Event::onlyTrashed()->where('id', $id)->firstOrFail();
            $this->deleteFileImportantImage($event);
            $event->forceDelete();
            Flash::success('Evento eliminado definitivamente con éxito.');
            return redirect()->route('events.trash');
        } catch (\Exception $e) {
            Flash::error('El evento tiene referencias en otra/s tabla/s por eso no será eliminado definitivamente. Si desea hacerlo primero debe quitar dichas referencias.');
            return redirect()->route('events.trash');
        }
    }

    /**
     * Restore the selected product
     */
    public function restore($id)
    {
        // Indicamos que la busqueda se haga en los registros eliminados con withTrashed
        $event = Event::withTrashed()->where('id', $id)->first();
        // Restauramos el registro
        $event->restore();
        Flash::success('El evento fue restaurado con éxito.');
        return redirect()->route('acontecimientos.index');
    }
}
