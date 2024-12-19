<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostGaleryImageRequest;
use App\Http\Requests\UpdatePostGaleryImageRequest;
use App\Repositories\PostGaleryImageRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class PostGaleryImageController extends AppBaseController
{
    /** @var  PostGaleryImageRepository */
    private $postGaleryImageRepository;

    public function __construct(PostGaleryImageRepository $postGaleryImageRepo)
    {
        $this->postGaleryImageRepository = $postGaleryImageRepo;
    }

    /**
     * Display a listing of the PostGaleryImage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $postGaleryImages = $this->postGaleryImageRepository->all();

        return view('post_galery_images.index')
            ->with('postGaleryImages', $postGaleryImages);
    }

    /**
     * Show the form for creating a new PostGaleryImage.
     *
     * @return Response
     */
    public function create()
    {
        return view('post_galery_images.create');
    }

    /**
     * Store a newly created PostGaleryImage in storage.
     *
     * @param CreatePostGaleryImageRequest $request
     *
     * @return Response
     */
    public function store(CreatePostGaleryImageRequest $request)
    {
        $input = $request->all();

        $postGaleryImage = $this->postGaleryImageRepository->create($input);

        Flash::success('Post Galery Image saved successfully.');

        return redirect(route('postGaleryImages.index'));
    }

    /**
     * Display the specified PostGaleryImage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $postGaleryImage = $this->postGaleryImageRepository->find($id);

        if (empty($postGaleryImage)) {
            Flash::error('Post Galery Image not found');

            return redirect(route('postGaleryImages.index'));
        }

        return view('post_galery_images.show')->with('postGaleryImage', $postGaleryImage);
    }

    /**
     * Show the form for editing the specified PostGaleryImage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $postGaleryImage = $this->postGaleryImageRepository->find($id);

        if (empty($postGaleryImage)) {
            Flash::error('Post Galery Image not found');

            return redirect(route('postGaleryImages.index'));
        }

        return view('post_galery_images.edit')->with('postGaleryImage', $postGaleryImage);
    }

    /**
     * Update the specified PostGaleryImage in storage.
     *
     * @param int $id
     * @param UpdatePostGaleryImageRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePostGaleryImageRequest $request)
    {
        $postGaleryImage = $this->postGaleryImageRepository->find($id);

        if (empty($postGaleryImage)) {
            Flash::error('Post Galery Image not found');

            return redirect(route('postGaleryImages.index'));
        }

        $postGaleryImage = $this->postGaleryImageRepository->update($request->all(), $id);

        Flash::success('Post Galery Image updated successfully.');

        return redirect(route('postGaleryImages.index'));
    }

    /**
     * Remove the specified PostGaleryImage from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $postGaleryImage = $this->postGaleryImageRepository->find($id);

        if (empty($postGaleryImage)) {
            Flash::error('Imagen de la galería no encontrada.');

            return redirect(route('posts.edit', $postGaleryImage->post_id));
        }

        $this->postGaleryImageRepository->delete($id);

        $this->deleteFileImage($postGaleryImage);

        Flash::success('Imagen de la galería eliminada con éxito.');

        return redirect(route('posts.edit', $postGaleryImage->post_id));
    }

    public function deleteFileImage($postGaleryImage)
    {
        if (\File::exists(public_path() . '/storage/post_galery/' . $postGaleryImage->image)) {
            \File::delete(public_path() . '/storage/post_galery/' . $postGaleryImage->image);
        } else {
            \Alert::message('¡La imagen de la galería no existe!', 'danger');
        }
    }
}
