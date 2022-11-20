<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'content' => 'required|string',
            'preview_image' => 'required|file',
            'main_image' => 'required|file',
            'category_id' => 'required|integer|exists:categories,id',
            'tag_ids' => 'nullable|array',
            'tag_ids.*' => 'nullable|integer|exists:tags,id',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Fill this field!',
            'title.string' => 'Wrong type of data',
            'content.required' => 'Fill this field!',
            'content.file' => 'Wrong type of data',
            'preview_image.required' => 'Choose image!',
            'preview_image.file' => 'File needed!',
            'main_image.required' => 'Choose image!',
            'main_image.file' => 'File needed!',
            'category_id.required' => 'Fill this field!',
            'category_id.integer' => 'Must be number!',
            'category_id.exists' => 'ID must exist!',
            'tag_ids.array' => 'Data massive needed',
        ];
    }
}
