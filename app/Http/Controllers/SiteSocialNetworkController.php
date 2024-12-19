<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSiteSocialNetworkRequest;
use App\Http\Requests\UpdateSiteSocialNetworkRequest;
use App\Repositories\SiteSocialNetworkRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\SiteSocialNetwork;
use Illuminate\Http\Request;
use Flash;
use Response;

use App\Models\SocialNetwork;

class SiteSocialNetworkController extends AppBaseController
{
    /** @var  SiteSocialNetworkRepository */
    private $siteSocialNetworkRepository;

    public function __construct(SiteSocialNetworkRepository $siteSocialNetworkRepo)
    {
        $this->siteSocialNetworkRepository = $siteSocialNetworkRepo;
    }

    /**
     * Display a listing of the SiteSocialNetwork.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $siteSocialNetworks = $this->siteSocialNetworkRepository->all();

        return view('panel.site_social_networks.index')
            ->with('siteSocialNetworks', $siteSocialNetworks);
    }

    /**
     * Show the form for creating a new SiteSocialNetwork.
     *
     * @return Response
     */
    public function create()
    {
        $social_networks = SocialNetwork::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        return view('panel.site_social_networks.create', compact('social_networks'));
    }

    /**
     * Store a newly created SiteSocialNetwork in storage.
     *
     * @param CreateSiteSocialNetworkRequest $request
     *
     * @return Response
     */
    public function store(CreateSiteSocialNetworkRequest $request)
    {
        if (SiteSocialNetwork::count() < 4) {
            $input = $request->all();

            $siteSocialNetwork = $this->siteSocialNetworkRepository->create($input);

            Flash::success('Red social del sitio guardada con éxito.');

            return redirect(route('sitio.redes.index'));
        } else {

            Flash::error('No se pueden agregar más de 4 redes sociales al sitio.');

            return redirect(route('sitio.redes.index'));
        }
    }

    /**
     * Display the specified SiteSocialNetwork.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $siteSocialNetwork = $this->siteSocialNetworkRepository->find($id);

        if (empty($siteSocialNetwork)) {
            Flash::error('Red social del sitio no encontrada.');

            return redirect(route('sitio.redes.index'));
        }

        return view('panel.site_social_networks.show')->with('siteSocialNetwork', $siteSocialNetwork);
    }

    /**
     * Show the form for editing the specified SiteSocialNetwork.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $siteSocialNetwork = $this->siteSocialNetworkRepository->find($id);

        if (empty($siteSocialNetwork)) {
            Flash::error('Red social del sitio no encontrada.');

            return redirect(route('sitio.redes.index'));
        }

        $social_networks = SocialNetwork::orderBy('name', 'ASC')->pluck('name', 'id')->all();

        return view('panel.site_social_networks.edit')
            ->with('siteSocialNetwork', $siteSocialNetwork)
            ->with('social_networks', $social_networks);
    }

    /**
     * Update the specified SiteSocialNetwork in storage.
     *
     * @param int $id
     * @param UpdateSiteSocialNetworkRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSiteSocialNetworkRequest $request)
    {
        $siteSocialNetwork = $this->siteSocialNetworkRepository->find($id);

        if (empty($siteSocialNetwork)) {
            Flash::error('Red social del sitio no encontrada.');

            return redirect(route('sitio.redes.index'));
        }

        $siteSocialNetwork = $this->siteSocialNetworkRepository->update($request->all(), $id);

        Flash::success('Red social del sitio actualizada con éxito.');

        return redirect(route('sitio.redes.index'));
    }

    /**
     * Remove the specified SiteSocialNetwork from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $siteSocialNetwork = $this->siteSocialNetworkRepository->find($id);

        if (empty($siteSocialNetwork)) {
            Flash::error('Red social del sitio no encontrada.');

            return redirect(route('sitio.redes.index'));
        }

        $this->siteSocialNetworkRepository->delete($id);

        Flash::success('Red social del sitio eliminada con éxito.');

        return redirect(route('sitio.redes.index'));
    }
}
