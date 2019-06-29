<?php

namespace InetStudio\FAQ\Tags\Services\Front;

use InetStudio\AdminPanel\Base\Services\BaseService;
use InetStudio\FAQ\Tags\Contracts\Models\TagModelContract;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\FAQ\Tags\Contracts\Services\Front\ItemsServiceContract;

/**
 * Class ItemsService.
 */
class ItemsService extends BaseService implements ItemsServiceContract
{
    /**
     * ItemsService constructor.
     *
     * @param  TagModelContract  $model
     */
    public function __construct(TagModelContract $model)
    {
        parent::__construct($model);
    }

    /**
     * Получаем активные объекты.
     *
     * @param  array  $params
     *
     * @return mixed
     *
     * @throws BindingResolutionException
     */
    public function getActiveItems(array $params = [])
    {
        $taggableModel = app()->make('InetStudio\FAQ\Tags\Contracts\Models\TaggableModelContract');

        $itemsIds = $taggableModel::select(['tag_model_id'])
            ->groupBy('tag_model_id')
            ->pluck('tag_model_id')
            ->toArray();;

        return $this->model->getItemById($itemsIds, $params);
    }
}
