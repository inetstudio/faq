<?php

namespace InetStudio\FAQ\Questions\Services\Back;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use InetStudio\AdminPanel\Base\Services\BaseService;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\FAQ\Questions\Contracts\Models\QuestionModelContract;
use InetStudio\FAQ\Questions\Contracts\Services\Back\ItemsServiceContract;

/**
 * Class ItemsService.
 */
class ItemsService extends BaseService implements ItemsServiceContract
{
    /**
     * ItemsService constructor.
     *
     * @param  QuestionModelContract  $model
     */
    public function __construct(QuestionModelContract $model)
    {
        parent::__construct($model);
    }

    /**
     * Сохраняем модель.
     *
     * @param  array  $data
     * @param  int  $id
     *
     * @return QuestionModelContract
     *
     * @throws BindingResolutionException
     */
    public function save(array $data, int $id): QuestionModelContract
    {
        $action = ($id) ? 'отредактирован' : 'создан';

        $item = $this->getItemById($id);
        $oldActivity = $item['is_active'];

        $itemData = Arr::only($data, $this->model->getFillable());
        $item = $this->saveModel($itemData, $id);

        resolve(
            'InetStudio\UploadsPackage\Uploads\Contracts\Actions\AttachMediaToObjectActionContract',
            [
                'item' => $item,
                'media' => Arr::get($data, 'media', []),
            ]
        )->execute();

        $tagsData = Arr::get($data, 'faq_tags', []);
        app()->make('InetStudio\FAQ\Tags\Contracts\Services\Back\ItemsServiceContract')
            ->attachToObject($tagsData, $item);

        $personsData = Arr::get($data, 'persons', []);
        app()->make('InetStudio\PersonsPackage\Persons\Contracts\Services\Back\ItemsServiceContract')
            ->attachToObject($personsData, $item);

        $item->searchable();

        event(
            app()->make(
                'InetStudio\FAQ\Questions\Contracts\Events\Back\ModifyItemEventContract',
                compact('item')
            )
        );

        if ($item['is_active'] == 1 && $oldActivity !== $item['is_active'] && $item['email']) {
            event(
                app()->make(
                    'InetStudio\FAQ\Questions\Contracts\Events\Back\ModifyItemActivityEventContract',
                    compact('item')
                )
            );
        }

        Session::flash('success', 'Вопрос успешно '.$action);

        return $item;
    }
}
