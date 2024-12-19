<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\SiteSocialNetwork;

class CreateSiteSocialNetworkRequest extends FormRequest
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
        return SiteSocialNetwork::$rules;
    }

    /**
     * Get the messages for validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return SiteSocialNetwork::$messages_es;
    }
}
