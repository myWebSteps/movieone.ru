<?php

namespace App\Http\Requests\Back\Admin\Movies;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'kinopoiskId'=>'required|string',
            'nameRu'=>'required|string',
            'nameEn'=>'required|string',
            'countries' => 'required',
            'category'=>'required|string',
            'genres'=>'required',
            'year'=>'required|string',
            'duration'=>'required|string',
            'rate'=>'required|string',
            'slogan'=>'required|string',
            'description'=>'required|string',
            'poster' => 'required',
            'type'=>'required|string',
        ];
    }
}
