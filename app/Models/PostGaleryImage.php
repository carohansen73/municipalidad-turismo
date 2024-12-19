<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class PostGaleryImage
 * @package App\Models
 * @version October 23, 2019, 10:50 am -03
 *
 * @property string image
 * @property integer post_id
 */
class PostGaleryImage extends Model
{
    public $table = 'post_galery_images';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'image',
        'post_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'image' => 'string',
        'post_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'image' => 'required|mimes:jpg,jpeg,png,bmp,svg'
    ];

    /**
     * Messages for validations
     *
     * @var array
     */
    public static $messages_es = [
        'image.required' => 'El campo imagen destacada es obligatorio.',
        'image.mimes' => 'El campo imagen destacada debe ser un archivo de tipo: jpg, jpeg, png, bmp, svg.',
    ];

    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }
}
