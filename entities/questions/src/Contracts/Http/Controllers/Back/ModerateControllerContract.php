<?php

namespace InetStudio\FAQ\Questions\Contracts\Http\Controllers\Back;

use Illuminate\Http\Request;
use InetStudio\FAQ\Questions\Contracts\Services\Back\ModerateServiceContract;
use InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Moderate\ReadResponseContract;
use InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Moderate\DestroyResponseContract;
use InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Moderate\ActivityResponseContract;

/**
 * Interface ModerateControllerContract.
 */
interface ModerateControllerContract
{
    /**
     * Изменение активности.
     *
     * @param  Request  $request
     * @param  ModerateServiceContract  $moderateService
     *
     * @return ActivityResponseContract
     */
    public function activity(
        Request $request,
        ModerateServiceContract $moderateService
    ): ActivityResponseContract;

    /**
     * Пометка "прочитано".
     *
     * @param  Request  $request
     * @param  ModerateServiceContract  $moderateService
     *
     * @return ReadResponseContract
     */
    public function read(
        Request $request,
        ModerateServiceContract $moderateService
    ): ReadResponseContract;

    /**
     * Удаление комментариев.
     *
     * @param  Request  $request
     * @param  ModerateServiceContract  $moderateService
     *
     * @return DestroyResponseContract
     */
    public function destroy(
        Request $request,
        ModerateServiceContract $moderateService
    ): DestroyResponseContract;
}
