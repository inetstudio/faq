<?php

namespace InetStudio\FAQ\Tags\Services\Front;

use InetStudio\AdminPanel\Services\Front\BaseService;
use InetStudio\FAQ\Tags\Contracts\Services\Front\TagsServiceContract;

/**
 * Class TagsService.
 */
class TagsService extends BaseService implements TagsServiceContract
{
    /**
     * TagsService constructor.
     */
    public function __construct()
    {
        parent::__construct(app()->make('InetStudio\FAQ\Tags\Contracts\Repositories\TagsRepositoryContract'));
    }
}
