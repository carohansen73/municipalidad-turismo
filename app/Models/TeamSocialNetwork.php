<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamSocialNetwork extends Model
{
    public $table = 'team_social_network';

    public $fillable = [
        'team_id',
        'social_network_id',
        'url'
    ];

    public static $rules = [
        'social_network_id' => 'required|numeric',
        'url' => 'required|string|max:100|unique:team_social_network'
    ];

    /**
     * Messages for validations
     *
     * @var array
     */
    public static $messages_es = [
        'social_network_id.required' => 'El campo red social es obligatorio.',
        'social_network_id.numeric' => 'El campo red social debe ser númerico.',
        'url.required' => 'El campo link es obligatorio.',
        'url.max' => 'El campo link no debe contener más de 100 caracteres.',
        'url.unique' => 'El valor del campo link ya está en uso.',
    ];

    public function socialNetwork()
    {
        return $this->belongsTo('App\Models\SocialNetwork');
    }

    public function team()
    {
        return $this->belongsTo('App\Models\Team');
    }
}
