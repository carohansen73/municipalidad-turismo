<?php

namespace App\Models;

// use Cviebrock\EloquentSluggable\Sluggable;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Event
 * @package App\Models
 * @version Septiembre 23, 2024, 10:41 am -03
 *
 * @property string name

 */
class Service extends Model
{
    // use SoftDeletes, Sluggable;

    public $table = 'service';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'img' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:100'
    ];

    /**
     * Messages for validations
     *
     * @var array
     */
    public static $messages_es = [
        'name.required' => 'El campo nombre del servicio es obligatorio.',
        'name.max' => 'El campo nombre del servicio no puede tener mas de 100 caracteres.'
    ];

    /**
     * Return the sluggable configuration array for this model. NOSE PARA Q SIR VE!
     *
     * @return array
     */
    // public function sluggable()
    // {
    //     return [
    //         'slug' => [
    //             'source' => 'title',
    //             'unique' => true,
    //             'onUpdate' => true,
    //         ]
    //     ];
    // }

    public function serviceProvider()
    {
        return $this->hasMany('App\Models\ServiceProvider');
    }






    // public function scopeSearch($query, $userSearch)
    // {
    //     return $query->where('title', 'Like', "%$userSearch%")->orWhere('publication_date', 'Like', "%$userSearch%")->where('publish', 1);
    // }
}

