<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class SiteSocialNetwork
 * @package App\Models
 * @version October 31, 2019, 11:00 am -03
 *
 * @property string url
 * @property integer social_network_id
 */
class SiteSocialNetwork extends Model
{
    public $table = 'site_social_networks';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'url',
        'social_network_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'url' => 'string',
        'social_network_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'url' => 'required|string|max:191|unique:site_social_networks',
        'social_network_id' => 'required|numeric|unique:site_social_networks'
    ];

    /**
     * Messages for validations
     *
     * @var array
     */
    public static $messages_es = [
        'url.required' => 'El campo link es obligatorio.',
        'url.max' => 'El campo link no debe contener más de 191 caracteres.',
        'url.unique' => 'El valor del campo link ya está en uso.',
        'social_network_id.required' => 'El campo red social es obligatorio.',
        'social_network_id.numeric' => 'El campo red social debe ser númerico.',
        'social_network_id.unique' => 'El valor del campo red social ya está en uso.',
    ];

    public function socialNetwork()
    {
        return $this->belongsTo('App\Models\SocialNetwork');
    }
}
