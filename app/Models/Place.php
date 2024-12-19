<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Cviebrock\EloquentSluggable\Sluggable;

/**
 * Class Place
 * @package App\Models
 * @version January 7, 2020, 8:09 am -03
 *
 * @property string title
 * @property string slug
 * @property string summary
 * @property string important_image
 * @property string content
 * @property boolean publish
 */
class Place extends Model
{
    use Sluggable;

    public $table = 'places';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'title',
        'slug',
        'summary',
        'important_image',
        'content',
        'publish',
        'place_category_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'slug' => 'string',
        'summary' => 'string',
        'important_image' => 'string',
        'content' => 'string',
        'publish' => 'boolean',
        'galery.*' => 'mimes:jpg,jpeg,png,bmp,svg'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|string|max:60',
        'slug' => 'string|max:60',
        'summary' => 'required|string|max:160',
        'important_image' => 'required|mimes:jpg,jpeg,png,bmp,svg',
        'content' => 'required|string',
        'publish' => 'boolean',
        'galery.*' => 'mimes:jpg,jpeg,png,bmp,svg'
    ];

    /**
     * Messages for validations
     *
     * @var array
     */
    public static $messages_es = [
        'title.required' => 'El campo título es obligatorio.',
        'title.max' => 'El campo título no debe contener más de 60 caracteres.',
        'summary.required' => 'El campo resumen es obligatorio.',
        'summary.max' => 'El campo resumen no debe contener más de 160 caracteres.',
        'content.required' => 'El campo contenido es obligatorio.',
        'important_image.required' => 'El campo imagen destacada es obligatorio.',
        'important_image.mimes' => 'El campo imagen destacada debe ser un archivo de tipo: jpg, jpeg, png, bmp, svg.',
        'publish.boolean' => 'El campo publicar debe ser verdadero o falso.',
        'galery.*.mimes' => 'El campo galería debe ser un archivo de tipo: jpg, jpeg, png, bmp, svg.',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
                'unique' => true,
                'onUpdate' => true,
            ]
        ];
    }

    public function category()
    {
        return $this->belongsTo('App\Models\PlaceCategory', 'place_category_id', 'id');
    }


    public function galeryImages()
    {
        return $this->hasMany('App\Models\PlaceGaleryImage');
    }
}
