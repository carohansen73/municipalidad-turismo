<?php

namespace App\Models;

// use Cviebrock\EloquentSluggable\Sluggable;

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
class ServiceProvider extends Model
{
    // use SoftDeletes, Sluggable;

    public $table = 'service_provider';


    protected $dates = ['deleted_at'];


    public $fillable = [

        'title',
        'description',
        'location_city', /*places_id ? o list seleccionable*/
        'loction_address',
        'price',
        'capacity',
        'considerations',
        'contact_name',
        'contact_email',
        'contact_ig',
        'contact_fb',
        'contact_web',

        'serv_id',
        'serv_type_id'

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'description' => 'string',
        'location_city' => 'string',
        'loction_address'  => 'string',
        'price'  => 'string',
        'capacity'  => 'integer',
        'considerations'  => 'string',
        'contact_name'  => 'string',
        'contact_email'  => 'string',
        'contact_ig'  => 'string',
        'contact_fb'  => 'string',
        'contact_web'  => 'string',

        'serv_id' => 'integer',
        'serv_type_id'  => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

        'title' => 'required|string|max:240',
        'description' => 'required|string',
        'location_city' => 'required|string',
        'considerations'  => 'string',
        'contact_name'  => 'required|string',
        'contact_email'  => 'string',
        // 'contact_phone_id'  => 'required|integer',
        'serv_type_id'  => 'integer',

        /*Zona? para filtrar x zona*/

    ];

    /**
     * Messages for validations
     *
     * @var array
     */
    public static $messages_es = [
        'title.required' => 'El campo título es obligatorio.',
        'description.required' => 'El campo descripción es obligatorio.',
        'location_city.required' => 'El campo ciudad es obligatorio.',
        'contact_name.required' => 'El campo nombre de contacto es obligatorio'
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

    public function service()
    {
        return $this->belongsTo('App\Models\Service', 'service_id', 'id');
    }

    public function type()
    {
        return $this->belongsTo('App\Models\ServiceType', 'service_type_id', 'id');
    }

    public function phones()
    {
        return $this->hasMany('App\Models\ServiceContactPhone');
    }

    public function images()
    {
        return $this->hasMany('App\Models\ServicePhotoGallery');
    }

    public function lastImage()
    {
        return $this->hasOne(ServicePhotoGallery::class)->latest();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function amenities()
    {
        //return $this->belongsToMany(User::class);
        return $this->belongsToMany(\App\Models\ServiceAmenities::class,'service_provider_amenities')->withPivot('amenities_id', 'service_provider_id');
        //return $this->belongsToMany(\App\Models\Categoria::class, 'noticia_id');
    }



    // public function scopeSearch($query, $userSearch)
    // {
    //     return $query->where('title', 'Like', "%$userSearch%")->orWhere('publication_date', 'Like', "%$userSearch%")->where('publish', 1);
    // }
}

