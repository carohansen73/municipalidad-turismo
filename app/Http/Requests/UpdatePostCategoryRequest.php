<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\PostCategory;

use Illuminate\Validation\Rule;

class UpdatePostCategoryRequest extends FormRequest
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
                'max:30',
                Rule::unique('post_categories', 'name')->ignore($this->segment(4)),
            ],
            'slug' => 'string|max:30',
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
        return PostCategory::$messages_es;
    }
}
