<?php

namespace InetStudio\FAQ\Tags\Services\Front;

use InetStudio\FAQ\Tags\Contracts\Services\Front\TagsServiceContract;
use InetStudio\FAQ\Tags\Contracts\Repositories\TagsRepositoryContract;

/**
 * Class TagsService.
 */
class TagsService implements TagsServiceContract
{
    /**
     * @var TagsRepositoryContract
     */
    private $repository;

    /**
     * TagsService constructor.
     *
     * @param TagsRepositoryContract $repository
     */
    public function __construct(TagsRepositoryContract $repository)
    {
        $this->repository = $repository;
    }
}
