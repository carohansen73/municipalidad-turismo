<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class SocialNetwork
 * @package App\Models
 * @version October 18, 2019, 1:23 pm -03
 *
 * @property string name
 * @property string icon
 */
class SocialNetwork extends Model
{
    public $table = 'social_networks';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'icon'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'icon' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:50|unique:social_networks',
        'icon' => 'required|string|max:50'
    ];

    /**
     * Messages for validations
     *
     * @var array
     */
    public static $messages_es = [
        'name.required' => 'El campo nombre es obligatorio.',
        'name.max' => 'El campo nombre no debe contener más de 50 caracteres.',
        'name.unique' => 'El valor del campo nombre ya está en uso.',
        'icon.required' => 'El campo ícono es obligatorio.',
        'icon.max' => 'El campo ícono no debe contener más de 50 caracteres.',
    ];

    public function teams()
    {
        return $this->belongsToMany('App\Models\Team');
    }

    public function site()
    {
        return $this->belongsToMany('App\Models\SiteSocialNetwork');
    }
}
