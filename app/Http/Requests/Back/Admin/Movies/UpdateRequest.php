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
            'id' => 'required',
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
            'default_plot' => 'required|integer',
            'default_actors_game' => 'required|integer',
            'default_atmosphere' => 'required|integer',
            'budget' => 'nullable|string',
            'slogan'=>'required|min:3|max:255',
            'description'=>'required|min:3|max:16300',
            'poster' => 'nullable',
            'backdrop' => 'nullable',
            'type'=>'required',
            'trailer'=>'nullable|string',
            'video_allowed' => 'required|boolean',
            'title_id' => 'required',
            'meta_keywords' => 'required|string|min:3|max:255',
            'meta_description' => 'required|string|min:3|max:16300',
            'spin_off' => 'nullable|array',
            'facts' => 'nullable|array',
            's_tracks_deleteIds' => 'nullable|array',
            'new_s_tracks' => 'nullable|array',
        ];
    }
}
