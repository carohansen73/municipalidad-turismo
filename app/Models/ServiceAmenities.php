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
class ServiceAmenities extends Model
{
    // use SoftDeletes, Sluggable;

    public $table = 'service_amenities';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string'
    ];

    /**
     * Messages for validations
     *
     * @var array
     */
    public static $messages_es = [
        'name.required' => 'El campo nombre es obligatorio.',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function serviceProvider()
    {
        return $this->belongsToMany(\App\Models\ServiceProvider::class,'service_provider_amenities')->withPivot('amenities_id', 'service_provider_id');
     }

}

