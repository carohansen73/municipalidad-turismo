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
class ServiceType extends Model
{
    // use SoftDeletes, Sluggable;

    public $table = 'service_type';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'type',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'type' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'type' => 'required|string|max:100'
    ];

    /**
     * Messages for validations
     *
     * @var array
     */
    public static $messages_es = [
        'type.required' => 'El campo tipo es obligatorio.',
        'type.max' => 'El campo tipo no puede tener mas de 100 caracteres.'
    ];



    public function serviceProvider()
    {
        return $this->hasMany('App\Models\ServiceProvider');
    }

}

