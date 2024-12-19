<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Repositories\TeamRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use App\Models\Team;
use App\Models\TeamSocialNetwork;
use App\Models\SocialNetwork;
use Image;

use App\Http\Requests\CreateTeamSocialNetworkRequest;
use App\Http\Requests\UpdateTeamSocialNetworkRequest;

class TeamController extends AppBaseController
{
    /** @var  TeamRepository */
    private $teamRepository;

    public function __construct(TeamRepository $teamRepo)
    {
        $this->teamRepository = $teamRepo;
    }

    /**
     * Display a listing of the Team.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $teams = $this->teamRepository->all();

        return view('panel.teams.index')
            ->with('teams', $teams);
    }

    /**
     * Show the form for creating a new Team.
     *
     * @return Response
     */
    public function create()
    {
        return view('panel.teams.create');
    }

    /**
     * Store a newly created Team in storage.
     *
     * @param CreateTeamRequest $request
     *
     * @return Response
     */
    public function store(CreateTeamRequest $request)
    {
        $team = new Team($request->all());
        if ($request->hasFile('important_image')) {
            $team->important_image = $this->uploadFileImportantImage($request);
        }
        $team->save();

        Flash::success('Miembro guardado con éxito.');
        return redirect(route('equipo.index'));
    }

    /**
     * Display the specified Team.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $team = $this->teamRepository->find($id);

        if (empty($team)) {
            Flash::error('Miembro no encontrado.');

            return redirect(route('equipo.index'));
        }

        return view('panel.teams.show')->with('team', $team);
    }

    /**
     * Show the form for editing the specified Team.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $team = $this->teamRepository->find($id);

        if (empty($team)) {
            Flash::error('Miembro no encontrado.');

            return redirect(route('equipo.index'));
        }

        return view('panel.teams.edit')->with('team', $team);
    }

    /**
     * Update the specified Team in storage.
     *
     * @param int $id
     * @param UpdateTeamRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTeamRequest $request)
    {
        $team = $this->teamRepository->find($id);

        if (empty($team)) {
            Flash::error('Miembro no encontrado.');
            return redirect(route('equipo.index'));
        }
        if ($request->hasFile('important_image')) {
            $this->deleteFileImportantImage($team);
            $team->important_image = $this->uploadFileImportantImage($request);
        }

        $team->name = $request->name;
        $team->job = $request->job;
        $team->publish = $request->publish;
        $team->save();

        Flash::success('Miembro actualizado con éxito.');

        return redirect(route('equipo.index'));
    }

    /**
     * Remove the specified Team from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $team = $this->teamRepository->find($id);

        if (empty($team)) {
            Flash::error('Miembro no encontrado.');

            return redirect(route('equipo.index'));
        }
        $this->deleteFileImportantImage($team);
        $this->teamRepository->delete($id);

        Flash::success('Miembro eliminado con éxito.');

        return redirect(route('equipo.index'));
    }

    public function uploadFileImportantImage($request)
    {
        // get file extension
        $extension = $request->file('important_image')->getClientOriginalExtension();
        // filename to store
        $filenametostore = str_slug($request->name . '-' . time()) . '.' . $extension;
        // Upload File
        $request->file('important_image')->storeAs('public/team', $filenametostore);
        // Resize image here
        $important_imagepath = public_path('storage/team/' . $filenametostore);
        // create a cached image and set a lifetime and return as object instead of string
        $img = Image::cache(function ($important_image) use ($filenametostore) {
            $important_image->make('storage/team/' . $filenametostore)->fit(263, 300);
        }, 10, true);
        $img->save($important_imagepath);
        return $filenametostore;
    }

    public function deleteFileImportantImage($team)
    {
        if (\File::exists(public_path() . '/storage/team/' . $team->important_image)) {
            \File::delete(public_path() . '/storage/team/' . $team->important_image);
        } else {
            Flash::error('¡La imagen no existe!');
        }
    }

    public function socialNetworkList($id)
    {
        $social_networks = TeamSocialNetwork::where('team_id', $id)->get();
        // $team_id = $id;
        $team = Team::findOrFail($id);
        return view('panel.teams.social_networks.index', compact('social_networks', 'team'));
    }

    public function socialNetworkCreate($id)
    {
        $team = Team::findOrFail($id);
        $social_networks = SocialNetwork::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        return view('panel.teams.social_networks.create', compact('team', 'social_networks'));
    }

    public function socialNetworkStore(CreateTeamSocialNetworkRequest $request)
    {
        $team_id = decrypt($request->id);
        $social_network_quantity = TeamSocialNetwork::where('team_id', $team_id)->get()->count();
        if ($social_network_quantity < 3) {
            $team_social_network = new TeamSocialNetwork($request->all());
            $team_social_network->team_id = $team_id;
            $team_social_network->save();

            Flash::success('Red social agregada con éxito.');
            return redirect(route('social.network.list', $team_id));
        } else {
            Flash::error('No se pueden agregar más de 3 redes sociales.');
            return redirect(route('social.network.list', $team_id));
        }
    }

    public function socialNetworkEdit($social_network_id)
    {
        $social_network = TeamSocialNetwork::findOrFail($social_network_id);
        $social_networks = SocialNetwork::orderBy('name', 'ASC')->pluck('name', 'id')->all();

        return view('panel.teams.social_networks.edit', compact('social_network', 'social_networks'));
    }

    public function socialNetworkUpdate($id, UpdateTeamSocialNetworkRequest $request)
    {
        $social_network = TeamSocialNetwork::findOrFail($id);
        $social_network->fill($request->all());
        $social_network->save();
        Flash::success('Red social actualizada con éxito.');
        return redirect(route('social.network.list', $social_network->team_id));
    }

    public function socialNetworkDestroy($id)
    {
        $social_network = TeamSocialNetwork::findOrFail($id);
        $social_network->delete();
        Flash::success('Red social eliminada con éxito.');
        return redirect(route('social.network.list', $social_network->team_id));
    }
}
