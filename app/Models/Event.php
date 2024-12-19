<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Event
 * @package App\Models
 * @version October 15, 2019, 10:41 am -03
 *
 * @property string title
 * @property string slug
 * @property string summary
 * @property string publication_date
 * @property string important_image
 * @property string location
 * @property string content
 * @property boolean publish
 * @property integer user_id
 */
class Event extends Model
{
    use SoftDeletes, Sluggable;

    public $table = 'events';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'title',
        'slug',
        'summary',
        'publication_date',
        'important_image',
        'location',
        'content',
        'publish',
        'user_id'
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
        'publication_date' => 'datetime',
        'important_image' => 'mimes:jpg,jpeg,png,bmp,svg',
        'location' => 'string',
        'content' => 'string',
        'publish' => 'boolean',
        'user_id' => 'integer'
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
        'publication_date' => 'required|date_format:Y-m-d H:i:s',
        'important_image' => 'required|mimes:jpg,jpeg,png,bmp,svg',
        'location' => 'required|string|max:80',
        'content' => 'required|string',
        'publish' => 'boolean'
    ];

    /**
     * Messages for validations
     *
     * @var array
     */
    public static $messages_es = [
        'title.required' => 'El campo título es obligatorio.',
        'title.max' => 'El campo título no debe contener más de 60 caracteres.',
        'summary.required' => 'El campo resumen es obligatorio',
        'summary.max' => 'El campo resumen no debe contener más de 160 caracteres.',
        'publication_date.required' => 'El campo fecha de publicación es obligatorio.',
        'publication_date.date_format' => 'El campo fecha de publicación no tiene formato valido año-mes-dia hora:minutos:segundos.',
        'important_image.required' => 'El campo imagen destacada es obligatorio.',
        'important_image.mimes' => 'El campo imagen destacada debe ser un archivo de tipo: jpg, jpeg, png, bmp, svg.',
        'location.required' => 'El campo ubicación es obligatorio.',
        'location.max' => 'El campo ubicación no debe contener más de 80 caracteres.',
        'content.required' => 'El campo contenido es obligatorio.',
        'publish.boolean' => 'El campo publicar debe ser verdadero o falso.',
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

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function scopeSearch($query, $userSearch)
    {
        return $query->where('title', 'Like', "%$userSearch%")->orWhere('publication_date', 'Like', "%$userSearch%")->where('publish', 1);
    }
}
