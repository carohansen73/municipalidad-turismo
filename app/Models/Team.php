<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Team
 * @package App\Models
 * @version October 18, 2019, 11:11 am -03
 *
 * @property string name
 * @property string job
 * @property string important_image
 * @property boolean publish
 */
class Team extends Model
{
    public $table = 'teams';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'job',
        'important_image',
        'publish'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'job' => 'string',
        'important_image' => 'string',
        'publish' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:80',
        'job' => 'required|string|max:30',
        'important_image' => 'required|mimes:jpg,jpeg,png,bmp,svg',
        'publish' => 'boolean'
    ];

    /**
     * Messages for validations
     *
     * @var array
     */
    public static $messages_es = [
        'name.required' => 'El campo nombre es obligatorio.',
        'name.max' => 'El campo nombre no debe contener más de 80 caracteres.',
        'job.required' => 'El campo trabajo/puesto es obligatorio.',
        'job.max' => 'El campo trabajo/puesto no debe contener más de 30 caracteres.',
        'important_image.required' => 'El campo imagen/avatar es obligatorio.',
        'important_image.mimes' => 'El campo imagen/avatar debe ser un archivo de tipo: jpg, jpeg, png, bmp, svg.',
        'publish.boolean' => 'El campo publicar debe ser verdadero o falso.',
    ];

    public function socialNetworks()
    {
        return $this->belongsToMany('App\Models\SocialNetwork', 'team_social_network')->withPivot('id', 'url');
    }
}
