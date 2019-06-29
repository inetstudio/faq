<?php

namespace InetStudio\FAQ\Questions\Contracts\Services\Back;

use InetStudio\FAQ\Questions\Contracts\Models\QuestionModelContract;
use InetStudio\AdminPanel\Base\Contracts\Services\BaseServiceContract;

/**
 * Interface ItemsServiceContract.
 */
interface ItemsServiceContract extends BaseServiceContract
{
    /**
     * Сохраняем модель.
     *
     * @param  array  $data
     * @param  int  $id
     *
     * @return QuestionModelContract
     */
    public function save(array $data, int $id): QuestionModelContract;
}
