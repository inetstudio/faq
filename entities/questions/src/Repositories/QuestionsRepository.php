<?php

namespace InetStudio\FAQ\Questions\Repositories;

use InetStudio\AdminPanel\Repositories\BaseRepository;
use InetStudio\FAQ\Tags\Repositories\Traits\TagsRepositoryTrait;
use InetStudio\FAQ\Questions\Contracts\Models\QuestionModelContract;
use InetStudio\Favorites\Repositories\Traits\FavoritesRepositoryTrait;
use InetStudio\FAQ\Questions\Contracts\Repositories\QuestionsRepositoryContract;

/**
 * Class QuestionsRepository.
 */
class QuestionsRepository extends BaseRepository implements QuestionsRepositoryContract
{
    use TagsRepositoryTrait;
    use FavoritesRepositoryTrait;

    /**
     * @var string
     */
    protected $favoritesType = 'faq_question';

    /**
     * QuestionsRepository constructor.
     *
     * @param QuestionModelContract $model
     */
    public function __construct(QuestionModelContract $model)
    {
        $this->model = $model;

        $this->defaultColumns = ['id', 'is_active', 'name', 'email'];
        $this->relations = [
            'persons' => function ($query) {
                $query->select(['id', 'name', 'slug']);
            },

            'tags' => function ($query) {
                $query->select(['id', 'name', 'title']);
            },
        ];
    }

    /**
     * Получаем активные объекты.
     *
     * @param array $params
     *
     * @return mixed
     */
    public function getActiveItems(array $params = [])
    {
        $builder = $this->getItemsQuery($params)->active();

        $items = $builder->get();

        return $items;
    }
}
