<?php

namespace InetStudio\FAQ\Questions\Http\Requests\Front;

use Arcanedev\NoCaptcha\Rules\CaptchaRule;
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
            'question.required' => 'Поле «Вопрос» обязательно для заполнения',

            'name.required' => 'Поле «Имя» обязательно для заполнения',
            'name.max' => 'Поле «Имя» не должно превышать 255 символов',

            'email.required' => 'Поле «Email» обязательно для заполнения',
            'email.max' => 'Поле «Email» не должно превышать 255 символов',
            'email.email' => 'Поле «Email» должно содержать значение в корректном формате',

            'g-recaptcha-response.required' => 'Поле «Капча» обязательно для заполнения',
            'g-recaptcha-response.captcha' => 'Неверный код капча',
        ];
    }

    /**
     * Правила проверки запроса.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = [
            'question' => 'required',
        ];

        if (! auth()->user()) {
            $rules = array_merge($rules, [
                'name' => 'required|max:255',
                'email' => 'required|max:255|email',
                'g-recaptcha-response' => [
                    'required',
                    new CaptchaRule,
                ],
            ]);
        }

        return $rules;
    }
}
