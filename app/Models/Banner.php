<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Banner
 * @package App\Models
 * @version October 15, 2019, 7:24 am -03
 *
 * @property string title
 * @property string important_image
 * @property boolean publish
 */
class Banner extends Model
{
    public $table = 'banners';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'title',
        'important_image',
        'publish',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'publish' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|string|max:85',
        'important_image' => 'required|mimes:jpg,jpeg,png,bmp,svg',
        'publish' => 'boolean'
    ];

    /**
     * Messages for validations
     *
     * @var array
     */
    public static $messages_es = [
        'title.required' => 'El campo título es obligatorio.',
        'title.max' => 'El campo título no debe contener más de 85 caracteres.',
        'important_image.required' => 'El campo imagen destacada es obligatorio.',
        'important_image.mimes' => 'El campo imagen destacada debe ser un archivo de tipo: jpg, jpeg, png, bmp, svg.',
        'publish.boolean' => 'El campo publicar debe ser verdadero o falso.',
    ];
}
