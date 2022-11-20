<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$this->user->id,
            'role' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Fill this field!',
            'name.string' => 'Wrong type of data',
            'email.required' => 'Fill this field!',
            'email.string' => 'Wrong type of data',
            'email.email' => 'Put correct email!',
            'email.unique' => 'That email already used!'

        ];
    }
}
