<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePlaceRequest;
use App\Http\Requests\UpdatePlaceRequest;
use App\Repositories\PlaceRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use App\Models\Place;
use App\Models\PlaceGaleryImage;
use App\Models\PlaceCategory;

use Image;

class PlaceController extends AppBaseController
{
    /** @var  PlaceRepository */
    private $placeRepository;

    public function __construct(PlaceRepository $placeRepo)
    {
        $this->placeRepository = $placeRepo;
    }

    /**
     * Display a listing of the Place.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $places = $this->placeRepository->all();

        return view('panel.places.index')
            ->with('places', $places);
    }

    /**
     * Show the form for creating a new Place.
     *
     * @return Response
     */
    public function create()
    {
        $place_categories = PlaceCategory::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        return view('panel.places.create',compact('place_categories'));
    }

    /**
     * Store a newly created Place in storage.
     *
     * @param CreatePlaceRequest $request
     *
     * @return Response
     */
    public function store(CreatePlaceRequest $request)
    {
        $place = new Place($request->all());
        if ($request->hasFile('important_image')) {
            $place->important_image = $this->uploadFileImportantImage($request);
        }
        $place->save();

        if ($request->hasFile('galery')) {
            if (count($request->galery) <= 9) {
                $this->uploadImagesToGallery($request, $place);
            } else {
                Flash::warning('No se pueden agregar más de 9 imágenes en la galería.');
            }
        }

        Flash::success('Lugar guardado con éxito.');

        return redirect(route('lugar.index'));
    }

    /**
     * Display the specified Place.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $place = $this->placeRepository->find($id);

        if (empty($place)) {
            Flash::error('Lugar no encontrado.');

            return redirect(route('places.index'));
        }

        return view('panel.places.show')->with('place', $place);
    }

    /**
     * Show the form for editing the specified Place.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $place = $this->placeRepository->find($id);

        if (empty($place)) {
            Flash::error('Lugar no encontrado.');

            return redirect(route('places.index'));
        }
        $place_categories = PlaceCategory::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        return view('panel.places.edit',compact('place','place_categories'));
    }

    /**
     * Update the specified Place in storage.
     *
     * @param int $id
     * @param UpdatePlaceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePlaceRequest $request)
    {
        $place = Place::findOrFail($id);
        if (empty($place)) {
            Flash::error('Lugar no encontrado.');

            return redirect(route('lugar.index'));
        }
        if ($request->hasFile('important_image')) {
            $this->deleteFileImportantImage($place);
            $place->important_image = $this->uploadFileImportantImage($request);
        }
        $place->title = $request->title;
        $place->summary = $request->summary;
        $place->content = $request->content;
        $place->publish = $request->publish;
        $place->place_category_id = $request->place_category_id;
        $place->save();

        if ($request->hasFile('galery')) {
            if (($place->galeryImages->count() + count($request->galery)) <= 9) {
                $this->uploadImagesToGallery($request, $place);
            } else {
                Flash::warning('El lugar ya posee 9 imágenes en la galería del lugar, elimine algunas si desea agregar nuevas.');
            }
        }

        Flash::success('Lugar actualizado con éxito.');
        return redirect(route('lugar.index'));
    }

    /**
     * Remove the specified Place from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $place = $this->placeRepository->find($id);

        if (empty($place)) {
            Flash::error('Lugar no encontrado.');

            return redirect(route('lugar.index'));
        }

        $this->deleteFileImportantImage($place);
        foreach ($place->galeryImages as $galeryImage) {
            $this->deleteFileGaleryImage($galeryImage);
        }
        $this->placeRepository->delete($id);

        Flash::success('Lugar eliminado con éxito.');

        return redirect(route('lugar.index'));
    }

    public function uploadFileImportantImage($request)
    {
        // get file extension
        $extension = $request->file('important_image')->getClientOriginalExtension();
        // filename to store
        $filenametostore = str_slug($request->title . '-' . time()) . '.' . $extension;
        // Upload File
        $request->file('important_image')->storeAs('public/places', $filenametostore);
        // Resize image here
        $important_imagepath = public_path('storage/places/' . $filenametostore);
        // create a cached image and set a lifetime and return as object instead of string
        $img = Image::cache(function ($important_image) use ($filenametostore) {
            $important_image->make('storage/places/' . $filenametostore)->fit(750, 450);
        }, 10, true);
        $img->save($important_imagepath);
        return $filenametostore;
    }

    public function deleteFileImportantImage($place)
    {
        if (\File::exists(public_path() . '/storage/places/' . $place->important_image)) {
            \File::delete(public_path() . '/storage/places/' . $place->important_image);
        } else {
            \Alert::message('¡La imagen del lugar no existe!', 'danger');
        }
    }

    public function singlePlace($place_slug)
    {
        $place = Place::where('publish', 1)->whereSlug($place_slug)->get()->first();

        return view('front.single-place', compact('place'));
    }

    /*
    *   Upload image files to the gallery of the place and add it to its corresponding table
    */
    public function uploadImagesToGallery(Request $request, Place $place)
    {
        $galery = $request->galery;
        $i = 0;
        foreach ($galery as $file) {
            // filename to store
            $filenametostore = str_slug(substr($place->title, 0, 50) . '-' . $i . '-' . time()) . '.' . $file->getClientOriginalExtension();
            // Upload File
            $file->storeAs('public/place_galery', $filenametostore);
            // Resize image here
            $image_path = public_path('storage/place_galery/' . $filenametostore);
            // create a cached image and set a lifetime and return as object instead of string
            $img = Image::cache(function ($image) use ($filenametostore) {
                $image->make('storage/place_galery/' . $filenametostore)->fit(750, 450);
            }, 10, true);
            $img->save($image_path);

            $place_galery_image = new PlaceGaleryImage();
            $place_galery_image->image = $filenametostore;
            $place_galery_image->place_id = $place->id;
            $place_galery_image->save();

            $i = $i + 1;
        }
    }

    public function deleteFileGaleryImage($galeryImage)
    {
        if (\File::exists(public_path() . '/storage/place_galery/' . $galeryImage->image)) {
            \File::delete(public_path() . '/storage/place_galery/' . $galeryImage->image);
        } else {
            \Alert::message('¡La imagen de la galería no existe!', 'danger');
        }
    }
}
