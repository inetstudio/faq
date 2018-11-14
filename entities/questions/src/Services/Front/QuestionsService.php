<?php

namespace InetStudio\FAQ\Questions\Services\Front;

use InetStudio\AdminPanel\Services\Front\BaseService;
use InetStudio\FAQ\Tags\Services\Front\Traits\TagsServiceTrait;
use InetStudio\Favorites\Services\Front\Traits\FavoritesServiceTrait;
use InetStudio\FAQ\Questions\Contracts\Services\Front\QuestionsServiceContract;

/**
 * Class QuestionsService.
 */
class QuestionsService extends BaseService implements QuestionsServiceContract
{
    use TagsServiceTrait;
    use FavoritesServiceTrait;

    /**
     * @var array
     */
    public $services;

    /**
     * QuestionsService constructor.
     */
    public function __construct()
    {
        parent::__construct(app()->make('InetStudio\FAQ\Questions\Contracts\Repositories\QuestionsRepositoryContract'));
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
        $usersService = app()->make('InetStudio\ACL\Users\Contracts\Services\Front\UsersServiceContract');

        $user = $usersService->getUser();

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
     * Получаем активные вопросы.
     *
     * @return mixed
     */
    public function getActiveItems()
    {
        return $this->repository->getActiveItems([
            'columns' => ['question', 'answer', 'updated_at'],
            'relations' => ['tags'],
        ]);
    }

    /**
     * Возвращаем используемые теги.
     *
     * @return mixed
     */
    public function getItemsTags()
    {
        $questions = $this->getActiveItems();

        return $questions->map(function ($item) {
            return $item->tags;
        })->collapse()->unique('id');
    }
}
