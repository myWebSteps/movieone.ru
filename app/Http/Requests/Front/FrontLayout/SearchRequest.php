<?php

namespace App\Http\Requests\Front\FrontLayout;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'key'=> 'required|min:3|max:50'
        ];
    }
    public function messages()
    {
        return [
            'key.min' => 'Поиск должен содержать минимум 3 символа',
            'key.max' => 'Поиск может содержать максимум 3 символа',
        ];
    }
}
