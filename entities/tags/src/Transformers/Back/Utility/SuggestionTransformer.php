<?php

namespace InetStudio\FAQ\Tags\Transformers\Back\Utility;

use League\Fractal\TransformerAbstract;
use InetStudio\FAQ\Tags\Contracts\Models\TagModelContract;
use League\Fractal\Resource\Collection as FractalCollection;
use InetStudio\FAQ\Tags\Contracts\Transformers\Back\Utility\SuggestionTransformerContract;

/**
 * Class SuggestionTransformer.
 */
class SuggestionTransformer extends TransformerAbstract implements SuggestionTransformerContract
{
    /**
     * @var string
     */
    protected $type;

    /**
     * SuggestionTransformer constructor.
     *
     * @param  string  $type
     */
    public function __construct(string $type = '')
    {
        $this->type = $type;
    }

    /**
     * Трансформация данных.
     *
     * @param  TagModelContract  $item
     *
     * @return array
     */
    public function transform(TagModelContract $item): array
    {
        return ($this->type == 'autocomplete')
            ? [
                'value' => $item['name'],
                'data' => [
                    'id' => $item['id'],
                    'type' => get_class($item),
                    'name' => $item['name'],
                ],
            ]
            : [
                'id' => $item['id'],
                'name' => $item['name'],
            ];
    }

    /**
     * Обработка коллекции объектов.
     *
     * @param $items
     *
     * @return FractalCollection
     */
    public function transformCollection($items): FractalCollection
    {
        return new FractalCollection($items, $this);
    }
}
