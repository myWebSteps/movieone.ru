<?php

namespace App\Http\Requests\Comments;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'id' => 'required|integer',
            'name' => 'required|string|min:3|max:50',
            'plot' => 'required|integer',
            'actors_game' => 'required|integer',
            'atmosphere' => 'required|integer',
            'rating' => 'required',
            'description' => 'required|string|min:5|max:500'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Имя - это обязательное поле',
            'name.min' => 'Имя должно содержать минимум 3 символа',
            'name.max' => 'Имя должно содержать максимум 50 символов',
            'plot' => 'Оцените сюжет',
            'actors_game' => 'Оцените игру актеров',
            'atmosphere' => 'Оцените атмосферу киноленты',
            'rating.required' => 'Рейтинг это обязательное поле',
            'description.required' => 'Отзыв это обязательное поле',
            'description.min' => 'Отзыв должен содержать минимум 5 символов',
            'description.max' => 'Отзыв должен быть максимум 500 символов',
        ];
    }
}
