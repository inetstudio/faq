<?php

namespace InetStudio\FAQ\Questions\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use InetStudio\FAQ\Questions\Http\Requests\Front\SaveItemRequest;
use InetStudio\FAQ\Questions\Contracts\Services\Front\ItemsServiceContract;
use InetStudio\FAQ\Questions\Contracts\Http\Responses\Front\SaveResponseContract;
use InetStudio\FAQ\Questions\Contracts\Http\Controllers\Front\ItemsControllerContract;

/**
 * Class ItemsController.
 */
class ItemsController extends Controller implements ItemsControllerContract
{
    /**
     * Сохранение объекта.
     *
     * @param  ItemsServiceContract  $questionsService
     * @param  SaveItemRequest  $request
     *
     * @return SaveResponseContract
     */
    public function save(ItemsServiceContract $questionsService, SaveItemRequest $request): SaveResponseContract
    {
        $data = $request->all();

        $result = $questionsService->save($data);

        return app()->makeWith(SaveResponseContract::class, [
            'result' => $result,
        ]);
    }
}
