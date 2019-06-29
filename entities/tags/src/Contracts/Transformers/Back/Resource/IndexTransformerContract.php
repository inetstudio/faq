<?php

namespace InetStudio\FAQ\Tags\Contracts\Transformers\Back\Resource;

use InetStudio\FAQ\Tags\Contracts\Models\TagModelContract;

/**
 * Interface IndexTransformerContract.
 */
interface IndexTransformerContract
{
    /**
     * Трансформация данных.
     *
     * @param  TagModelContract  $item
     *
     * @return array
     */
    public function transform(TagModelContract $item): array;
}
