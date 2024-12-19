<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\PostTag;

use Illuminate\Validation\Rule;

class UpdatePostTagRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:20',
                Rule::unique('post_tags', 'name')->ignore($this->segment(4)),
            ],
            'slug' => 'string|max:20',
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
        return PostTag::$messages_es;
    }
}
