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
class ServicePhotoGallery extends Model
{
    // use SoftDeletes, Sluggable;

    public $table = 'service_photo_gallery';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'service_provider_id',
        'photo_url'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'service_provider_id' => 'integer',
        'photo_url' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'service_provider_id' => 'required|integer',
        'photo_url' => 'required'
    ];

    /**
     * Messages for validations
     *
     * @var array
     */
    public static $messages_es = [
        'service_provider_id.required' => 'El campo peroveedor de servicio es obligatorio.',
        'service_provider_id.integer' => 'El campo peroveedor de servicio debe ser numerico',
        'photo_url.required' => 'El campo imagen es obligatorio.'
    ];


    public function serviceProvider()
    {
        return $this->belongsTo('App\Models\ServiceProvider', 'service_provider_id', 'id');
    }


}

