<?php

namespace InetStudio\FAQ\Tags\Repositories;

use InetStudio\AdminPanel\Repositories\BaseRepository;
use InetStudio\FAQ\Tags\Contracts\Models\TagModelContract;
use InetStudio\FAQ\Tags\Contracts\Repositories\TagsRepositoryContract;

/**
 * Class TagsRepository.
 */
class TagsRepository extends BaseRepository implements TagsRepositoryContract
{
    /**
     * TagsRepository constructor.
     *
     * @param TagModelContract $model
     */
    public function __construct(TagModelContract $model)
    {
        $this->model = $model;

        $this->defaultColumns = ['id', 'name', 'title'];
    }
}
