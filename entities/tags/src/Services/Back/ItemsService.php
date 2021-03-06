<?php

namespace InetStudio\FAQ\Tags\Services\Back;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use InetStudio\AdminPanel\Base\Services\BaseService;
use InetStudio\FAQ\Tags\Contracts\Models\TagModelContract;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\FAQ\Tags\Contracts\Services\Back\ItemsServiceContract;

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
     * Сохраняем модель.
     *
     * @param  array  $data
     * @param  int  $id
     *
     * @return TagModelContract
     *
     * @throws BindingResolutionException
     */
    public function save(array $data, int $id): TagModelContract
    {
        $action = ($id) ? 'отредактирован' : 'создан';

        $itemData = Arr::only($data, $this->model->getFillable());
        $item = $this->saveModel($itemData, $id);

        $item->searchable();

        event(
            app()->make(
                'InetStudio\FAQ\Tags\Contracts\Events\Back\ModifyItemEventContract',
                compact('item')
            )
        );

        Session::flash('success', 'Тег «'.$item->name.'» успешно '.$action);

        return $item;
    }

    /**
     * Присваиваем теги объекту.
     *
     * @param $tags
     * @param $item
     */
    public function attachToObject($tags, $item): void
    {
        if ($tags instanceof Request) {
            $tags = $tags->get('faq_tags', []);
        } else {
            $tags = (array) $tags;
        }

        if (! empty($tags)) {
            $item->syncTags($this->model::whereIn('id', $tags)->get());
        } else {
            $item->detachTags($item->tags);
        }
    }
}
