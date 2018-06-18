<?php

namespace InetStudio\FAQ\Questions\Services\Front;

use InetStudio\FAQ\Questions\Contracts\Services\Front\QuestionsServiceContract;
use InetStudio\FAQ\Questions\Contracts\Repositories\QuestionsRepositoryContract;

/**
 * Class QuestionsService.
 */
class QuestionsService implements QuestionsServiceContract
{
    /**
     * @var QuestionsRepositoryContract
     */
    private $repository;

    /**
     * @var array
     */
    private $services;

    /**
     * QuestionsService constructor.
     *
     * @param QuestionsRepositoryContract $repository
     */
    public function __construct(QuestionsRepositoryContract $repository)
    {
        $this->repository = $repository;
        $this->services['classifiers'] = app()->make('InetStudio\Classifiers\Contracts\Services\Back\ClassifiersServiceContract');
        $this->services['users'] = app()->make('InetStudio\ACL\Users\Contracts\Services\Front\UsersServiceContract');
    }

    /**
     * Сохраняем вопрос.
     *
     * @param array $data
     *
     * @return array
     */
    public function save(array $data): array
    {
        $user = $this->services['users']->getUser();

        $question = $this->repository->save([
            'is_read' => 0,
            'is_active' => 0,
            'user_id' => ($user) ? $user->id : 0,
            'name' => ($user) ? $user->name : $data['name'],
            'email' => ($user) ? $user->email : $data['email'],
            'question' => $data['question'],
        ], 0);

        $result = ($question && isset($question->id));

        if ($result) {
            $this->services['classifiers']->attachToObject(request(), $question);

            event(app()->makeWith('InetStudio\FAQ\Questions\Contracts\Events\Front\SendQuestionEventContract', [
                'question' => $question,
            ]));
        }

        return [
            'success' => $result,
            'message' => ($result) ? trans('admin.module.faq.questions::questions.send_success') : trans('admin.module.faq.questions::questions.send_fail'),
        ];
    }
}
