<?php

namespace App\Http\Requests\Back\Admin\Collections;

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
            'collection_title'=>'required|string|min:3|max:40',
            'description_min'=>'required|string|min:3|max:150',
            'description'=>'required|string|min:3|max:16300',
            'poster' => 'required|file',
            'articles' => 'required|array',
            'articles.*.article_title' => 'required|string',
            'articles.*.article_image' => 'required',
            'articles.*.article_description' => 'required|string',
            'articles.*.article_movie' => 'nullable|integer',
            'meta_title' => 'required|string|min:3|max:255',
            'meta_keywords'=>'required|string|min:3|max:255',
            'meta_description'=>'required|string|min:3|max:16300',
        ];
    }
}
