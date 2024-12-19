<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlaceGaleryImage extends Model
{
    public $table = 'place_galery_images';

    public $fillable = [
        'image',
        'place_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'image' => 'string',
        'place_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'image' => 'required|mimes:jpg,jpeg,png,bmp,svg'
    ];

    /**
     * Messages for validations
     *
     * @var array
     */
    public static $messages_es = [
        'image.required' => 'El campo imagen destacada es obligatorio.',
        'image.mimes' => 'El campo imagen destacada debe ser un archivo de tipo: jpg, jpeg, png, bmp, svg.',
    ];

    public function place()
    {
        return $this->belongsTo('App\Models\Place');
    }
}
