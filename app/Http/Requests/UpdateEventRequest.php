<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Event;

class UpdateEventRequest extends FormRequest
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
            'publication_date' => 'required|date_format:Y-m-d H:i:s',
            'important_image' => 'mimes:jpg,jpeg,png,bmp,svg',
            'location' => 'required|string|max:80',
            'content' => 'required|string',
            'publish' => 'boolean'
        ];
    }

    /**
     * Get the messages for validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return Event::$messages_es;
    }
}
