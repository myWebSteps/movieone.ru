<?php

namespace App\Http\Requests\Back\Admin\Genres;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'category_id' => 'required|string',
            'title' => ['required', Rule::unique('genres')->where(function ($query){
                return $query->where('category_id', $this->category_id)->where('title', $this->title);
            })],
            'slug' => ['required', Rule::unique('genres')->where(function ($query){
                return $query->where('category_id', $this->category_id)->where('slug', $this->slug);
            })]
        ];
    }
}
