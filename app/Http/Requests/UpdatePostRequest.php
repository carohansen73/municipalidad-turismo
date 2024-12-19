<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Post;

class UpdatePostRequest extends FormRequest
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
            'slug' => 'string|max:191',
            'summary' => 'required|string|max:160',
            'content' => 'required|string',
            'post_category_id' => 'required|numeric',
            'important_image' => 'mimes:jpg,jpeg,png,bmp,svg',
            'publish' => 'boolean',
            'signature_author' => 'boolean',
            'galery.*' => 'mimes:jpg,jpeg,png,bmp,svg',
            'video_iframe' => 'nullable|string|max:191|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'
        ];
    }

    /**
     * Get the messages for validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return Post::$messages_es;
    }
}
