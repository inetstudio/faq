<?php

namespace InetStudio\FAQ\Questions\Http\Requests\Back;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use InetStudio\FAQ\Questions\Contracts\Http\Requests\Back\SaveQuestionRequestContract;

/**
 * Class SaveQuestionRequest.
 */
class SaveQuestionRequest extends FormRequest implements SaveQuestionRequestContract
{
    /**
     * Определить, авторизован ли пользователь для этого запроса.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Сообщения об ошибках.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Поле «Имя» обязательно для заполнения',
            'name.max' => 'Поле «Имя» не должно превышать 255 символов',

            'classifiers.required' => 'Поле «Тип кожи» обязательно для заполнения',

            'persons.required' => 'Поле «Эксперты» обязательно для заполнения',

            'answer.text.required_if' => 'Поле «Ответ» обязательно для заполнения',
        ];
    }

    /**
     * Правила проверки запроса.
     *
     * @param Request $request
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'name' => ($request->has('name')) ? 'required|max:255' : '',
            'classifiers' => 'required',
            'persons' => 'required',
            'answer.text' => 'required_if:is_active,1',
        ];
    }
}
