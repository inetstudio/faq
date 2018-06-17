<?php

namespace InetStudio\FAQ\Tags\Http\Requests\Back;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use InetStudio\FAQ\Tags\Contracts\Http\Requests\Back\SaveTagRequestContract;

/**
 * Class SaveTagRequest.
 */
class SaveTagRequest extends FormRequest implements SaveTagRequestContract
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
            'name.required' => 'Поле «Название» обязательно для заполнения',
            'name.max' => 'Поле «Название» не должно превышать 255 символов',
            'name.unique' => 'Такое значение поля «Название» уже существует',

            'title.max' => 'Поле «Заголовок» не должно превышать 255 символов',
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
            'name' => 'required|max:255|unique:faq_tags,name,'.$request->get('tag_id'),
            'title' => 'max:255',
        ];
    }
}
