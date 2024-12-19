<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBannerRequest;
use App\Http\Requests\UpdateBannerRequest;
use App\Repositories\BannerRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use App\Models\Banner;
use Image;

class BannerController extends AppBaseController
{
    /** @var  BannerRepository */
    private $bannerRepository;

    public function __construct(BannerRepository $bannerRepo)
    {
        $this->bannerRepository = $bannerRepo;
    }

    /**
     * Display a listing of the Banner.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $banners = $this->bannerRepository->all();

        return view('panel.banners.index')
            ->with('banners', $banners);
    }

    /**
     * Show the form for creating a new Banner.
     *
     * @return Response
     */
    public function create()
    {
        return view('panel.banners.create');
    }

    /**
     * Store a newly created Banner in storage.
     *
     * @param CreateBannerRequest $request
     *
     * @return Response
     */
    public function store(CreateBannerRequest $request)
    {
        if (Banner::count() < 1) {
            $banner = new Banner($request->all());
            if ($request->hasFile('important_image')) {
                $banner->important_image = $this->uploadFileImportantImage($request);
            }
            $banner->save();
            Flash::success('Banner guardado con éxito.');
            return redirect(route('banners.index'));
        } else {
            Flash::error('No se pueden crear más de 1 banner. Eliminé o edité el banner creado con anterioridad.');
            return redirect(route('banners.index'));
        }
    }

    /**
     * Display the specified Banner.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $banner = $this->bannerRepository->find($id);

        if (empty($banner)) {
            Flash::error('Banner no encontrado.');

            return redirect(route('banners.index'));
        }

        return view('panel.banners.show')->with('banner', $banner);
    }

    /**
     * Show the form for editing the specified Banner.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $banner = $this->bannerRepository->find($id);

        if (empty($banner)) {
            Flash::error('Banner no encontrado.');

            return redirect(route('banners.index'));
        }

        return view('panel.banners.edit')->with('banner', $banner);
    }

    /**
     * Update the specified Banner in storage.
     *
     * @param int $id
     * @param UpdateBannerRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBannerRequest $request)
    {
        $banner = Banner::findOrFail($id);
        if (empty($banner)) {
            Flash::error('Banner no encontrado.');
            return redirect(route('banners.index'));
        }
        if ($request->hasFile('important_image')) {
            $this->deleteFileImportantImage($banner);
            $banner->important_image = $this->uploadFileImportantImage($request);
        }
        $banner->title = $request->title;
        $banner->publish = $request->publish;
        $banner->save();

        Flash::success('Banner actualizado con éxito.');

        return redirect(route('banners.index'));
    }

    /**
     * Remove the specified Banner from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $banner = $this->bannerRepository->find($id);

        if (empty($banner)) {
            Flash::error('Banner no encontrado.');

            return redirect(route('banners.index'));
        }
        $this->deleteFileImportantImage($banner);
        $this->bannerRepository->delete($id);

        Flash::success('Banner eliminado con éxito.');

        return redirect(route('banners.index'));
    }

    public function uploadFileImportantImage($request)
    {
        // get file extension
        $extension = $request->file('important_image')->getClientOriginalExtension();
        // filename to store
        $filenametostore = str_slug($request->title . '-' . time()) . '.' . $extension;
        // Upload File
        $request->file('important_image')->storeAs('public/banners', $filenametostore);
        // Resize image here
        $important_imagepath = public_path('storage/banners/' . $filenametostore);
        // create a cached image and set a lifetime and return as object instead of string
        $img = Image::cache(function ($important_image) use ($filenametostore) {
            $important_image->make('storage/banners/' . $filenametostore)->fit(1920, 820);
        }, 10, true);
        $img->save($important_imagepath);
        return $filenametostore;
    }

    public function deleteFileImportantImage($banner)
    {
        if (\File::exists(public_path() . '/storage/banners/' . $banner->important_image)) {
            \File::delete(public_path() . '/storage/banners/' . $banner->important_image);
        } else {
            \Alert::message('¡La imagen del banner no existe!', 'danger');
        }
    }
}
