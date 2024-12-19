<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSiteConfigurationRequest;
use App\Http\Requests\UpdateSiteConfigurationRequest;
use App\Repositories\SiteConfigurationRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\SiteConfiguration;
use Illuminate\Http\Request;
use Flash;
use Response;

use Image;

class SiteConfigurationController extends AppBaseController
{
    /** @var  SiteConfigurationRepository */
    private $siteConfigurationRepository;

    public function __construct(SiteConfigurationRepository $siteConfigurationRepo)
    {
        $this->siteConfigurationRepository = $siteConfigurationRepo;
    }

    /**
     * Display a listing of the SiteConfiguration.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $siteConfigurations = $this->siteConfigurationRepository->all();

        return view('panel.site_configurations.index')
            ->with('siteConfigurations', $siteConfigurations);
    }

    /**
     * Show the form for creating a new SiteConfiguration.
     *
     * @return Response
     */
    public function create()
    {
        return view('panel.site_configurations.create');
    }

    /**
     * Store a newly created SiteConfiguration in storage.
     *
     * @param CreateSiteConfigurationRequest $request
     *
     * @return Response
     */
    public function store(CreateSiteConfigurationRequest $request)
    {
        $input = $request->all();

        $siteConfiguration = $this->siteConfigurationRepository->create($input);

        Flash::success('Configuración del sitio guardada con exito.');

        return redirect(route('siteConfigurations.index'));
    }

    /**
     * Display the specified SiteConfiguration.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $siteConfiguration = $this->siteConfigurationRepository->find($id);

        if (empty($siteConfiguration)) {
            Flash::error('Configuración del sitio no encontrada.');

            return redirect(route('siteConfigurations.index'));
        }

        return view('panel.site_configurations.show')->with('siteConfiguration', $siteConfiguration);
    }

    /**
     * Show the form for editing the specified SiteConfiguration.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit()
    {
        $siteConfiguration = SiteConfiguration::findOrFail(1);

        if (empty($siteConfiguration)) {
            Flash::error('Configuración del sitio no encontrada.');

            return redirect(route('dashboard'));
        }

        return view('panel.site_configurations.edit')->with('siteConfiguration', $siteConfiguration);
    }

    /**
     * Update the specified SiteConfiguration in storage.
     *
     * @param int $id
     * @param UpdateSiteConfigurationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSiteConfigurationRequest $request)
    {
        $siteConfiguration = $this->siteConfigurationRepository->find($id);

        if (empty($siteConfiguration)) {
            Flash::error('Configuración del sitio no encontrada.');

            return redirect(route('siteConfigurations.edit'));
        }

        // $siteConfiguration = $this->siteConfigurationRepository->update($request->all(), $id);
        $siteConfiguration->fill($request->all());        

        if ($request->hasFile('logo_main'))
        {
            $this->deleteFileLogoMain($siteConfiguration);
            $siteConfiguration->logo_main = $this->uploadFileLogoMain($request, $siteConfiguration);
        }

        if ($request->hasFile('logo_panel'))
        {
            $this->deleteFileLogoPanel($siteConfiguration);
            $siteConfiguration->logo_panel = $this->uploadFileLogoPanel($request, $siteConfiguration);
        }

        $siteConfiguration->save();

        Flash::success('Configuración del sitio actualizada con éxito.');

        return redirect(route('siteConfigurations.edit'));
    }

    /**
     * Remove the specified SiteConfiguration from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $siteConfiguration = $this->siteConfigurationRepository->find($id);

        if (empty($siteConfiguration)) {
            Flash::error('Configuración del sitio no encontrada.');

            return redirect(route('siteConfigurations.index'));
        }

        $this->siteConfigurationRepository->delete($id);

        Flash::success('Configuración del sitio eliminada con éxito.');

        return redirect(route('siteConfigurations.index'));
    }

    public function uploadFileLogoMain($request, $siteConfiguration)
    {
        $extension = $request->file('logo_main')->getClientOriginalExtension();
        // filename to store
        $filenametostore = str_slug('logo_main' . time()) . '.' . $extension;
        // Upload File
        $request->file('logo_main')->storeAs('public/logo_main', $filenametostore);
        // Resize image here
        $important_imagepath = public_path('storage/logo_main/' . $filenametostore);
        // create a cached image and set a lifetime and return as object instead of string
        $img = Image::cache(function ($important_image) use ($filenametostore) {
            $important_image->make('storage/logo_main/' . $filenametostore)->fit(125, 30);
        }, 10, true);
        $img->save($important_imagepath);
        return $filenametostore;
    }

    public function deleteFileLogoMain($siteConfiguration)
    {
        if (\File::exists(public_path() . '/storage/logo_main/' . $siteConfiguration->logo_main)) {
            \File::delete(public_path() . '/storage/logo_main/' . $siteConfiguration->logo_main);
        } else {
            \Alert::message('¡El logo principal no existe!', 'danger');
        }
    }

    public function uploadFileLogoPanel($request, $siteConfiguration)
    {
        $extension = $request->file('logo_panel')->getClientOriginalExtension();
        // filename to store
        $filenametostore = str_slug('logo_panel' . time()) . '.' . $extension;
        // Upload File
        $request->file('logo_panel')->storeAs('public/logo_panel', $filenametostore);
        // Resize image here
        $important_imagepath = public_path('storage/logo_panel/' . $filenametostore);
        // create a cached image and set a lifetime and return as object instead of string
        $img = Image::cache(function ($important_image) use ($filenametostore) {
            $important_image->make('storage/logo_panel/' . $filenametostore)->fit(150, 150);
        }, 10, true);
        $img->save($important_imagepath);
        return $filenametostore;
    }

    public function deleteFileLogoPanel($siteConfiguration)
    {
        if (\File::exists(public_path() . '/storage/logo_panel/' . $siteConfiguration->logo_panel)) {
            \File::delete(public_path() . '/storage/logo_panel/' . $siteConfiguration->logo_panel);
        } else {
            \Alert::message('¡El logo del panel no existe!', 'danger');
        }
    }
}
