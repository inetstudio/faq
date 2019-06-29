<?php

namespace InetStudio\FAQ\Questions\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;
use InetStudio\FAQ\Questions\Contracts\Http\Requests\Back\SaveItemRequestContract;

/**
 * Class SaveItemRequest.
 */
class SaveItemRequest extends FormRequest implements SaveItemRequestContract
{
    /**
     * Определить, авторизован ли пользователь для этого запроса.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Сообщения об ошибках.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Поле «Имя» обязательно для заполнения',
            'name.max' => 'Поле «Имя» не должно превышать 255 символов',

            'answer.text.required_if' => 'Поле «Ответ» обязательно для заполнения',
        ];
    }

    /**
     * Правила проверки запроса.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ($this->has('name')) ? 'required|max:255' : '',
            'answer.text' => 'required_if:is_active,1',
        ];
    }
}
