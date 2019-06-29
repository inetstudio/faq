<?php

namespace InetStudio\FAQ\Questions\Http\Controllers\Back;

use Illuminate\Http\Request;
use InetStudio\AdminPanel\Base\Http\Controllers\Controller;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\FAQ\Questions\Contracts\Services\Back\ModerateServiceContract;
use InetStudio\FAQ\Questions\Contracts\Http\Controllers\Back\ModerateControllerContract;
use InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Moderate\ReadResponseContract;
use InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Moderate\DestroyResponseContract;
use InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Moderate\ActivityResponseContract;

/**
 * Class ModerateController.
 */
class ModerateController extends Controller implements ModerateControllerContract
{
    /**
     * Изменение активности.
     *
     * @param  Request  $request
     * @param  ModerateServiceContract  $moderateService
     *
     * @return ActivityResponseContract
     *
     * @throws BindingResolutionException
     */
    public function activity(
        Request $request,
        ModerateServiceContract $moderateService
    ): ActivityResponseContract {
        $ids = $request->get('questions', []);

        $result = $moderateService->updateActivity($ids);

        return $this->app->make(ActivityResponseContract::class, compact('result'));
    }

    /**
     * Пометка "прочитано".
     *
     * @param  Request  $request
     * @param  ModerateServiceContract  $moderateService
     *
     * @return ReadResponseContract
     *
     * @throws BindingResolutionException
     */
    public function read(
        Request $request,
        ModerateServiceContract $moderateService
    ): ReadResponseContract {
        $ids = $request->get('questions', []);

        $result = $moderateService->updateRead($ids);

        return $this->app->make(ReadResponseContract::class, compact('result'));
    }

    /**
     * Удаление отзывов.
     *
     * @param  Request  $request
     * @param  ModerateServiceContract  $moderateService
     *
     * @return DestroyResponseContract
     *
     * @throws BindingResolutionException
     */
    public function destroy(
        Request $request,
        ModerateServiceContract $moderateService
    ): DestroyResponseContract {
        $ids = $request->get('questions', []);

        $result = $moderateService->destroy($ids);

        return $this->app->make(DestroyResponseContract::class, compact('result'));
    }
}
