<?php

namespace App\Http\Requests\Back\Admin\Genres;

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
            'category_id' => 'required',
            'slug' => ['required', Rule::unique('genres')->where(function ($query){
                $query->where('category_id', $this->category_id)->where('slug', $this->slug);})->ignore($this->id)],
            'title' => ['required', Rule::unique('genres')->where(function ($query){
                $query->where('category_id', $this->category_id)->where('title', $this->title);})->ignore($this->id)],
        ];
    }
}
