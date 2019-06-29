<?php

namespace InetStudio\FAQ\Questions\Contracts\Services\Front;

use InetStudio\AdminPanel\Base\Contracts\Services\BaseServiceContract;

/**
 * Interface ItemsServiceContract.
 */
interface ItemsServiceContract extends BaseServiceContract
{
    /**
     * Сохраняем вопрос.
     *
     * @param  array  $data
     *
     * @return array
     */
    public function save(array $data): array;
}
