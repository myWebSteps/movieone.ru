<?php

namespace App\Http\Requests\Back\Admin\Collections;

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
            'collection_id' => 'required|integer',
            'collection_title'=>'required|string',
            'is_published' => 'required|boolean',
            'poster' => 'required',
            'slug' => ['required', Rule::unique('collections', 'id')->ignore($this->id)],
            'description_min'=>'required|string',
            'description'=>'required|string',
            'articles' => 'required|array',
            'articles.*.article_title' => 'required|string',
            'articles.*.article_image' => 'required',
            'articles.*.article_description' => 'required|string',
            'articles.*.article_movie' => 'nullable|integer',
            'meta_title'=> 'required|string',
            'meta_keywords' => 'required|string',
            'meta_description'=>'required|string',
        ];
    }
}
