<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SiteConfiguration
 * @package App\Models
 * @version November 4, 2019, 10:45 am -03
 *
 * @property string title_place
 * @property string subtitle_place
 * @property string title_news
 * @property string subtitle_news
 * @property string title_events
 * @property string subtitle_events
 * @property string title_team
 * @property string subtitle_team
 * @property string description_team
 */
class SiteConfiguration extends Model
{
    use SoftDeletes;

    public $table = 'site_configurations';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'title_place',
        'subtitle_place',
        'title_news',
        'subtitle_news',
        'title_events',
        'subtitle_events',
        'title_team',
        'subtitle_team',
        'description_team'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title_place' => 'string',
        'subtitle_place' => 'string',
        'title_news' => 'string',
        'subtitle_news' => 'string',
        'title_events' => 'string',
        'subtitle_events' => 'string',
        'title_team' => 'string',
        'subtitle_team' => 'string',
        'description_team' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title_place' => 'required|string|max:191',
        'subtitle_place' => 'required|string|max:191',
        'title_news' => 'required|string|max:191',
        'subtitle_news' => 'required|string|max:191',
        'title_events' => 'required|string|max:191',
        'subtitle_events' => 'required|string|max:191',
        'title_team' => 'required|string|max:191',
        'subtitle_team' => 'required|string|max:191',
        'description_team' => 'required|string'
    ];

    /**
     * Messages for validations
     *
     * @var array
     */
    public static $messages_es = [
        'title_place.required' => 'El campo título de la sección lugares es obligatorio.',
        'title_place.max' => 'El campo título de la sección lugares no debe contener más de 191 caracteres.',
        'subtitle_place.required' => 'El campo subtítulo de la sección lugares es obligatorio.',
        'subtitle_place.max' => 'El campo subtítulo de la sección lugares no debe contener más de 191 caracteres.',
        'title_news.required' => 'El campo título de la sección noticias es obligatorio.',
        'title_news.max' => 'El campo título de la sección noticias no debe contener más de 191 caracteres.',
        'subtitle_news.required' => 'El campo subtítulo de la sección noticias es obligatorio.',
        'subtitle_news.max' => 'El campo subtítulo de la sección noticias no debe contener más de 191 caracteres.',
        'title_events.required' => 'El campo título de la sección eventos/acontecimientos es obligatorio.',
        'title_events.max' => 'El campo título de la sección eventos/acontecimientos no debe contener más de 191 caracteres.',
        'title_events.required' => 'El campo subtítulo de la sección eventos/acontecimientos es obligatorio.',
        'title_events.max' => 'El campo subtítulo de la sección eventos/acontecimientos no debe contener más de 191 caracteres.',
        'title_team.required' => 'El campo título de la sección equipo es obligatorio.',
        'title_team.max' => 'El campo título de la sección equipo no debe contener más de 191 caracteres.',
        'subtitle_team.required' => 'El campo subtítulo de la sección equipo es obligatorio.',
        'subtitle_team.max' => 'El campo subtítulo de la sección equipo no debe contener más de 191 caracteres.',
        'description_team.required' => 'El campo texto o frase del equipo es obligatorio.',
    ];
}
