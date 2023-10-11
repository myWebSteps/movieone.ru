<?php

namespace App\Http\Requests\Back\Admin\Movies;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'kinopoisk_id'=>'nullable',
            'nameRu'=>'nullable',
            'nameEn'=>'nullable',
            'countries' => 'nullable',
            'category_id'=>'nullable',
            'genres'=>'nullable',
            'year'=>'nullable',
            'duration'=>'nullable',
            'rate'=>'nullable',
            'slogan'=>'nullable',
            'description'=>'nullable',
            'poster' => 'nullable',
            'type'=>'nullable',
        ];
    }
}
