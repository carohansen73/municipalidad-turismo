<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;

use Eloquent as Model;

/**
 * Class PostTag
 * @package App\Models
 * @version September 27, 2019, 8:39 am -03
 *
 * @property string name
 * @property string slug
 * @property boolean publish
 */
class PostTag extends Model
{
    use Sluggable;

    public $table = 'post_tags';


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
        'name' => 'required|string|max:20|unique:post_tags',
        'slug' => 'string|max:20',
        'publish' => 'boolean'
    ];

    /**
     * Messages for validations
     *
     * @var array
     */
    public static $messages_es = [
        'name.required' => 'El campo nombre es obligatorio.',
        'name.max' => 'El campo nombre no debe contener más de 20 caracteres.',
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

    public function posts()
    {
        return $this->belongsToMany('App\Models\Post', 'post_tag')->withTimestamps();
    }

    public function postPublished()
    {
        return $this->posts()->where('publish', 1);
    }

    public function scopeSearchTag($query, $slug)
    {
        $query->whereSlug($slug);
    }
}
