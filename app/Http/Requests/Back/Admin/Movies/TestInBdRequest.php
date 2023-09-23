<?php

namespace App\Http\Requests\Back\Admin\Movies;

use Illuminate\Foundation\Http\FormRequest;

class TestInBdRequest extends FormRequest
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
            'kinopoisk_id'=>'required',
        ];
    }
}
