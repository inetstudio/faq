<?php

namespace InetStudio\FAQ\Questions\Http\Requests\Front;

use Illuminate\Support\Facades\Auth;
use Arcanedev\NoCaptcha\Rules\CaptchaRule;
use Illuminate\Foundation\Http\FormRequest;
use InetStudio\FAQ\Questions\Contracts\Http\Requests\Front\SaveQuestionRequestContract;

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
            'question.required' => 'Поле «Сообщение» обязательно для заполнения',

            'name.required' => 'Поле «Имя» обязательно для заполнения',
            'name.max' => 'Поле «Имя» не должно превышать 255 символов',

            'email.required' => 'Поле «Email» обязательно для заполнения',
            'email.max' => 'Поле «Email» не должно превышать 255 символов',
            'email.email' => 'Поле «Email» должно содержать значение в корректном формате',

            'qa-policy-agree.required' => 'Обязательно для заполнения',

            'g-recaptcha-response.required' => 'Поле «Капча» обязательно для заполнения',
            'g-recaptcha-response.captcha'  => 'Неверный код капча',
        ];
    }

    /**
     * Правила проверки запроса.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'question' => 'required',
            'qa-policy-agree' => 'required',
        ];

        if (! Auth::user()) {
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
