<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Models\TeamSocialNetwork;

use Illuminate\Validation\Rule;

class UpdateTeamSocialNetworkRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'url' => [
                'required',
                'string',
                'max:100',
                Rule::unique('team_social_network', 'url')->ignore($this->segment(4)),
            ],
            'social_network_id' => 'required|numeric'
        ];
    }

    /**
     * Get the messages for validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return TeamSocialNetwork::$messages_es;
    }
}
