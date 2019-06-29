<?php

namespace InetStudio\FAQ\Tags\Contracts\Services\Front;

use InetStudio\AdminPanel\Base\Contracts\Services\BaseServiceContract;

/**
 * Interface ItemsServiceContract.
 */
interface ItemsServiceContract extends BaseServiceContract
{
    /**
     * Получаем активные объекты.
     *
     * @param  array  $params
     *
     * @return mixed
     */
    public function getActiveItems(array $params = []);
}
