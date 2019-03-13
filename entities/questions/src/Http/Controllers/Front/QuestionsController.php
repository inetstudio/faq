<?php

namespace InetStudio\FAQ\Questions\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Arcanedev\NoCaptcha\Rules\CaptchaRule;
use InetStudio\FAQ\Questions\Contracts\Http\Responses\Front\SaveResponseContract;
use InetStudio\FAQ\Questions\Contracts\Http\Controllers\Front\QuestionsControllerContract;

/**
 * Class QuestionsController.
 */
class QuestionsController extends Controller implements QuestionsControllerContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    public $services;

    /**
     * QuestionsController constructor.
     */
    public function __construct()
    {
        $this->services['questions'] = app()->make(
            'InetStudio\FAQ\Questions\Contracts\Services\Front\QuestionsServiceContract'
        );
    }

    /**
     * Сохранение объекта.
     *
     * @param Request $request
     *
     * @return SaveResponseContract
     */
    public function save(Request $request): SaveResponseContract
    {
        $rules = [
            'question' => 'required',
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

        Validator::make($request->all(), $rules, [
            'question.required' => 'Поле «Вопрос» обязательно для заполнения',
            'name.required' => 'Поле «Имя» обязательно для заполнения',
            'name.max' => 'Поле «Имя» не должно превышать 255 символов',
            'email.required' => 'Поле «Email» обязательно для заполнения',
            'email.max' => 'Поле «Email» не должно превышать 255 символов',
            'email.email' => 'Поле «Email» должно содержать значение в корректном формате',
            'g-recaptcha-response.required' => 'Поле «Капча» обязательно для заполнения',
            'g-recaptcha-response.captcha'  => 'Неверный код капча',
        ])->validate();

        $result = $this->services['questions']->save($request->all());

        return app()->makeWith(SaveResponseContract::class, [
            'result' => $result,
        ]);
    }
}
