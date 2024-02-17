<?php

namespace App\Http\Requests\Back\Admin\Comments\Movies;

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
            'movie_id' => 'required|integer',
            'name' => 'required|string',
            'description' => 'required|string',
            'approved' => 'required|boolean'
        ];
    }
}
