<?php

namespace App\Http\Requests\Comments;

use Illuminate\Foundation\Http\FormRequest;

class CollectionCreateRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:50',
            'rate' => 'required|integer',
            'comment' => 'required|string|min:5|max:500'
        ];
    }

    public function messages()
    {
        return [
            'collection_id.required' => 'ID коллекции недоступен',
            'name.required' => 'Имя - это обязательное поле',
            'name.min' => 'Имя должно содержать минимум 3 символа',
            'name.max' => 'Имя должно содержать максимум 50 символов',
            'rate.required' => 'Рейтинг это обязательное поле',
            'comment.min' => 'Отзыв должен содержать минимум 5 символов',
            'comment.max' => 'Отзыв должен быть максимум 500 символов',
        ];
    }
}