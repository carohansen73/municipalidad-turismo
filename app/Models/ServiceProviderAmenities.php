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
class ServiceProviderAmenities extends Model
{
    // use SoftDeletes, Sluggable;

    public $table = 'service_provider_amenities';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'amenities_id',
        'service_provider_id'
    ];
}
