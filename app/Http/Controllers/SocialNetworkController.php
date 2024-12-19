<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSocialNetworkRequest;
use App\Http\Requests\UpdateSocialNetworkRequest;
use App\Repositories\SocialNetworkRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class SocialNetworkController extends AppBaseController
{
    /** @var  SocialNetworkRepository */
    private $socialNetworkRepository;

    public function __construct(SocialNetworkRepository $socialNetworkRepo)
    {
        $this->socialNetworkRepository = $socialNetworkRepo;
    }

    /**
     * Display a listing of the SocialNetwork.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $socialNetworks = $this->socialNetworkRepository->all();

        return view('panel.social_networks.index')
            ->with('socialNetworks', $socialNetworks);
    }

    /**
     * Show the form for creating a new SocialNetwork.
     *
     * @return Response
     */
    public function create()
    {
        return view('panel.social_networks.create');
    }

    /**
     * Store a newly created SocialNetwork in storage.
     *
     * @param CreateSocialNetworkRequest $request
     *
     * @return Response
     */
    public function store(CreateSocialNetworkRequest $request)
    {
        $input = $request->all();

        $socialNetwork = $this->socialNetworkRepository->create($input);

        Flash::success('Red social guardada con éxito.');

        return redirect(route('redes.index'));
    }

    /**
     * Display the specified SocialNetwork.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $socialNetwork = $this->socialNetworkRepository->find($id);

        if (empty($socialNetwork)) {
            Flash::error('Red social no encontrada.');

            return redirect(route('redes.index'));
        }

        return view('panel.social_networks.show')->with('socialNetwork', $socialNetwork);
    }

    /**
     * Show the form for editing the specified SocialNetwork.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $socialNetwork = $this->socialNetworkRepository->find($id);

        if (empty($socialNetwork)) {
            Flash::error('Red social no encontrada.');

            return redirect(route('redes.index'));
        }

        return view('panel.social_networks.edit')->with('socialNetwork', $socialNetwork);
    }

    /**
     * Update the specified SocialNetwork in storage.
     *
     * @param int $id
     * @param UpdateSocialNetworkRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSocialNetworkRequest $request)
    {
        $socialNetwork = $this->socialNetworkRepository->find($id);

        if (empty($socialNetwork)) {
            Flash::error('Red social no encontrada.');

            return redirect(route('redes.index'));
        }

        $socialNetwork = $this->socialNetworkRepository->update($request->all(), $id);

        Flash::success('Red social actualizada con éxito.');

        return redirect(route('redes.index'));
    }

    /**
     * Remove the specified SocialNetwork from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $socialNetwork = $this->socialNetworkRepository->find($id);

        if (empty($socialNetwork)) {
            Flash::error('Red social no encontrada.');

            return redirect(route('redes.index'));
        }

        $this->socialNetworkRepository->delete($id);

        Flash::success('Red social eliminada con éxito.');

        return redirect(route('redes.index'));
    }
}
