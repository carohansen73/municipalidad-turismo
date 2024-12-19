<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Place;

class UpdatePlaceRequest extends FormRequest
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
            'title' => 'required|string|max:60',
            'slug' => 'string|max:60',
            'summary' => 'required|string|max:160',
            'important_image' => 'mimes:jpg,jpeg,png,bmp,svg',
            'content' => 'required|string',
            'publish' => 'boolean',
            'galery.*' => 'mimes:jpg,jpeg,png,bmp,svg'
        ];
    }

    /**
     * Get the messages for validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return Place::$messages_es;
    }
}
