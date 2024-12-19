<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Repositories\UserRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\User;

use Illuminate\Support\Facades\DB;

use Bouncer;
use Image;

class UserController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the User.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $users = $this->userRepository->all();

        return view('panel.users.index')
            ->with('users', $users);
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        $roles = Bouncer::role()::orderBy('title', 'ASC')->pluck('title', 'id')->all();
        $user_role_id = null;
        return view('panel.users.create', compact('roles', 'user_role_id'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $user = new User($request->all());
        $user->password = bcrypt($request->password);
        $user->save();
        // Asigno el rol
        if ($request->rol == 1) {
            $user->assign('superadmin');
        } elseif ($request->rol == 2) {
            $user->assign('admin');
        }


        Flash::success('Usuario guardado con éxito.');

        return redirect(route('usuarios.index'));
    }

    /**
     * Display the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('Usuario no encontrado.');

            return redirect(route('usuarios.index'));
        }

        return view('panel.users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->find($id);

        $roles = Bouncer::role()::orderBy('title', 'ASC')->pluck('title', 'id')->all();
        $user_role_id = DB::table('bouncer_assigned_roles')->where('entity_id', $id)->first()->role_id;

        if (empty($user)) {
            Flash::error('Usuario no encontrado.');

            return redirect(route('usuarios.index'));
        }

        return view('panel.users.edit')->with('user', $user)
            ->with('roles', $roles)
            ->with('user_role_id', $user_role_id);
    }

    /**
     * Update the specified User in storage.
     *
     * @param int $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $user = User::findOrFail($id);

        if (empty($user)) {
            Flash::error('Usuario no encontrado.');

            return redirect(route('usuarios.index'));
        }
        $user->fill($request->all());
        $user->password = bcrypt($request->password);
        $user->save();

        // Remuevo el rol
        Bouncer::retract($user->getRoles()[0])->from($user);
        // Asigno el rol
        if ($request->rol == 1) {
            $user->assign('superadmin');
        } elseif ($request->rol == 2) {
            $user->assign('admin');
        }
        // Refresco los roles y permisos
        Bouncer::refresh();

        if (\Auth::user()->getRoles()[0] == "superadmin") {
            Flash::success('Usuario actualizado con éxito.');
            return redirect(route('usuarios.index'));
        } else {
            return redirect(route('dashboard'));
        }
    }

    /**
     * Remove the specified User from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('Usuario no encontrado.');

            return redirect(route('usuarios.index'));
        }

        $this->userRepository->delete($id);

        Flash::success('Usuario eliminado con éxito.');

        return redirect(route('usuarios.index'));
    }

    public function showProfile()
    {
        $user = User::findOrFail(\Auth()->user()->id);
        return view('panel.users.profiles.show', compact('user'));
    }

    public function updateProfile(UpdateProfileRequest $request, $id)
    {
        $user = User::findOrFail($id);

        if ($request->hasFile('image')) {
            $this->deleteFileImage($user);
            $user->image = $this->uploadFileImage($request, $user);
        }

        if (isset($request->password)) {
            if ($request->password == $request->password_confirmation) {
                $user->password = bcrypt($request->password);
            } else {
                Flash::error('Las contraseñas no coinciden. Por lo tanto, no va a ser modificada.');
            }
        }

        $user->bio = $request->bio;
        $user->job = $request->job;
        $user->save();

        Flash::success('Datos actualizados con éxito.');

        return redirect(route('profile'));
    }

    public function uploadFileImage($request, $user)
    {
        $extension = $request->file('image')->getClientOriginalExtension();
        // filename to store
        $filenametostore = str_slug($user->name . '-' . $user->lastname . '-' . time()) . '.' . $extension;
        // Upload File
        $request->file('image')->storeAs('public/users', $filenametostore);
        // Resize image here
        $important_imagepath = public_path('storage/users/' . $filenametostore);
        // create a cached image and set a lifetime and return as object instead of string
        $img = Image::cache(function ($important_image) use ($filenametostore) {
            $important_image->make('storage/users/' . $filenametostore)->fit(263, 300);
        }, 10, true);
        $img->save($important_imagepath);
        return $filenametostore;
    }

    public function deleteFileImage($user)
    {
        if (\File::exists(public_path() . '/storage/users/' . $user->image)) {
            \File::delete(public_path() . '/storage/users/' . $user->image);
        } else {
            \Alert::message('¡La imagen del usuario no existe!', 'danger');
        }
    }
}
