<?php

namespace InetStudio\FAQ\Tags\Contracts\Transformers\Back\Utility;

use InetStudio\FAQ\Tags\Contracts\Models\TagModelContract;
use League\Fractal\Resource\Collection as FractalCollection;

/**
 * Interface SuggestionTransformerContract.
 */
interface SuggestionTransformerContract
{
    /**
     * Трансформация данных.
     *
     * @param  TagModelContract  $item
     *
     * @return array
     */
    public function transform(TagModelContract $item): array;

    /**
     * Обработка коллекции объектов.
     *
     * @param $items
     *
     * @return FractalCollection
     */
    public function transformCollection($items): FractalCollection;
}
