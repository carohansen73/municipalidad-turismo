<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Bouncer;
use Silber\Bouncer\Database\HasRolesAndAbilities;


class User extends Authenticatable
{
    use Notifiable, HasRolesAndAbilities;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'lastname', 'email', 'image', 'job', 'bio', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:20',
        'lastname' => 'required|string|max:20',
        'email' => 'required|string|max:191|unique:users',
        'password' => 'required|string|min:8|max:20|confirmed',
        'rol' => 'required|numeric'
    ];

    /**
     * Messages for validations
     *
     * @var array
     */
    public static $messages_es = [
        'name.required' => 'El campo nombre es obligatorio.',
        'name.max' => 'El campo nombre no debe contener más de 20 caracteres.',
        'lastname.required' => 'El campo apellido es obligatorio.',
        'lastname.max' => 'El campo apellido no debe contener más de 20 caracteres.',
        'email.required' => 'El campo email es obligatorio.',
        'email.max' => 'El campo email no debe contener más de 191 caracteres.',
        'password.required' => 'El campo contraseña es obligatorio.',
        'password.min' => 'El campo contraseña debe contener al menos 8 caracteres.',
        'password.max' => 'El campo contraseña no debe contener más de 20 caracteres.',
        'password.confirmed' => 'El campo confirmación de contraseña no coincide.'
    ];

    public function isSuperAdmin()
    {
        return Bouncer::is($this)->an('superadmin');
    }
}
