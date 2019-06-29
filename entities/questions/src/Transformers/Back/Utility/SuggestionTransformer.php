<?php

namespace InetStudio\FAQ\Questions\Transformers\Back\Utility;

use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection as FractalCollection;
use InetStudio\FAQ\Questions\Contracts\Models\QuestionModelContract;
use InetStudio\FAQ\Questions\Contracts\Transformers\Back\Utility\SuggestionTransformerContract;

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
     * @param  QuestionModelContract  $item
     *
     * @return array
     */
    public function transform(QuestionModelContract $item): array
    {
        return ($this->type == 'autocomplete')
            ? [
                'value' => $item['question'],
                'data' => [
                    'id' => $item['id'],
                    'type' => get_class($item),
                    'question' => $item['question'],
                ],
            ]
            : [
                'id' => $item['id'],
                'question' => $item['question'],
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
