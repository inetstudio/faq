<?php

namespace InetStudio\FAQ\Tags\Repositories;

use InetStudio\AdminPanel\Repositories\BaseRepository;
use InetStudio\FAQ\Tags\Contracts\Models\TaggableModelContract;
use InetStudio\FAQ\Tags\Contracts\Repositories\TaggablesRepositoryContract;

/**
 * Class TaggablesRepository.
 */
class TaggablesRepository extends BaseRepository implements TaggablesRepositoryContract
{
    /**
     * TaggablesRepository constructor.
     *
     * @param TaggableModelContract $model
     */
    public function __construct(TaggableModelContract $model)
    {
        $this->model = $model;

        $this->defaultColumns = ['tag_model_id', 'taggable_id', 'taggable_type'];
    }

    /**
     * Получаем уникальные ID тегов.
     */
    public function getUniqueTagsIDs(): array
    {
        return $this->getItemsQuery()
            ->select(['tag_model_id'])
            ->groupBy('tag_model_id')
            ->pluck('tag_model_id')
            ->toArray();
    }
}
