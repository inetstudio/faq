<?php

namespace InetStudio\FAQ\Questions\Services\Front;

use InetStudio\FAQ\Questions\Contracts\Models\QuestionModelContract;
use InetStudio\FAQ\Questions\Contracts\Services\Front\QuestionsServiceContract;

/**
 * Class QuestionsService.
 */
class QuestionsService implements QuestionsServiceContract
{
    /**
     * @var
     */
    public $repository;

    /**
     * @var array
     */
    public $services;

    /**
     * QuestionsService constructor.
     */
    public function __construct()
    {
        $this->repository = app()->make('InetStudio\FAQ\Questions\Contracts\Repositories\QuestionsRepositoryContract');
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
            event(app()->makeWith('InetStudio\FAQ\Questions\Contracts\Events\Front\SendQuestionEventContract', [
                'question' => $question,
            ]));
        }

        return [
            'success' => $result,
            'message' => ($result) ? trans('admin.module.faq.questions::questions.send_success') : trans('admin.module.faq.questions::questions.send_fail'),
        ];
    }

    /**
     * Получаем вопрос по ID.
     *
     * @param int $id
     *
     * @return QuestionModelContract|null
     */
    public function getQuestionByID(int $id = 0): ?QuestionModelContract
    {
        return $this->repository->searchItems([['id', '=', $id]], ['question', 'answer', 'updated_at'], ['persons'])->first();
    }

    /**
     * Получаем активные вопросы.
     *
     * @return mixed
     */
    public function getActiveQuestions()
    {
        return $this->repository->getActiveItems(['question', 'answer', 'updated_at'], ['persons']);
    }

    /**
     * Получаем вопросы по тегам.
     *
     * @param array $tags
     *
     * @return mixed
     */
    public function getQuestionsByTags(array $tags)
    {
        return $this->repository->getItemsByTags($tags, ['question', 'answer', 'updated_at'], ['persons']);
    }


    /**
     * Получаем избранные вопросы.
     *
     * @param $userID
     *
     * @return mixed
     */
    public function getQuestionsFavoritedByUser($userID)
    {
        return ($userID)
            ? $this->repository->getItemsFavoritedByUser($userID, ['question', 'answer', 'updated_at'], ['persons'])
            : collect([]);
    }
}
