<?php

namespace InetStudio\FAQ\Questions\Services\Back;

use InetStudio\AdminPanel\Base\Services\BaseService;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\FAQ\Questions\Contracts\Models\QuestionModelContract;
use InetStudio\FAQ\Questions\Contracts\Services\Back\ModerateServiceContract;

/**
 * Class ModerateService.
 */
class ModerateService extends BaseService implements ModerateServiceContract
{
    /**
     * ModerateService constructor.
     *
     * @param  QuestionModelContract  $model
     */
    public function __construct(QuestionModelContract $model)
    {
        parent::__construct($model);
    }

    /**
     * @param  mixed  $ids
     * @param  array  $params
     *
     * @return bool
     *
     * @throws BindingResolutionException
     */
    public function updateActivity($ids, array $params = []): bool
    {
        $items = $this->getItemById($ids, $params);

        foreach ($items as $item) {
            $item->update(
                [
                    'is_active' => ! $item->is_active,
                    'is_read' => 1,
                ]
            );

            event(
                app()->make(
                    'InetStudio\FAQ\Questions\Contracts\Events\Back\ModifyItemEventContract',
                    compact('item')
                )
            );
        }

        return true;
    }

    /**
     * Пометка "прочитано".
     *
     * @param $ids
     * @param  array  $params
     *
     * @return bool
     *
     * @throws BindingResolutionException
     */
    public function updateRead($ids, array $params = []): bool
    {
        $items = $this->getItemById($ids, $params);

        foreach ($items as $item) {
            $item->update(
                [
                    'is_read' => 1,
                ]
            );

            event(
                app()->make(
                    'InetStudio\FAQ\Questions\Contracts\Events\Back\ModifyItemEventContract',
                    compact('item')
                )
            );
        }

        return true;
    }
}
