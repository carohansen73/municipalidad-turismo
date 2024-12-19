<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;

use Eloquent as Model;

/**
 * Class PostCategory
 * @package App\Models
 * @version September 26, 2019, 10:17 am -03
 *
 * @property string name
 * @property string slug
 * @property boolean publish
 */
class PlaceCategory extends Model
{
    use Sluggable;

    public $table = 'place_categories';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'slug',
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
        'slug' => 'string',
        'publish' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:30|unique:post_categories',
        'slug' => 'string|max:30',
        'publish' => 'boolean'
    ];

    /**
     * Messages for validations
     *
     * @var array
     */
    public static $messages_es = [
        'name.required' => 'El campo nombre es obligatorio.',
        'name.max' => 'El campo nombre no debe contener más de 30 caracteres.',
        'name.unique' => 'El valor del campo nombre ya está en uso.',
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
                'source' => 'name',
                'unique' => true,
                'onUpdate' => true,
            ]
        ];
    }

    public function place()
    {
        return $this->hasMany('App\Models\Place');
    }

    /*public function postPublished()
    {
        return $this->posts()->where('publish', 1);
    }*/

    public function scopeSearchCategory($query, $slug)
    {
        $query->whereSlug($slug);
    }
}
