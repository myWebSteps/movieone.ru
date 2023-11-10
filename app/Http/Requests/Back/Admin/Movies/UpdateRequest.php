<?php

namespace App\Http\Requests\Back\Admin\Movies;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'kinopoisk_id'=>'required',
            'slug' => ['required', Rule::unique('movies', 'id')->ignore($this->id)],
            'nameRu'=>'required',
            'nameEn'=>'required',
            'trailers' => 'nullable|array',
            'age_limits'=> 'required',
            'countries' => 'required',
            'category_id'=>'required',
            'genres'=>'required',
            'year'=>'required',
            'duration'=>'required',
            'rate'=>'required',
            'budget' => 'required|string',
            'slogan'=>'required',
            'description'=>'required',
            'poster' => 'nullable',
            'type'=>'required',
            'trailer'=>'nullable|string',
            'video_allowed' => 'required|boolean',
        ];
    }
}
