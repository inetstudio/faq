<?php

namespace InetStudio\FAQ\Questions\Contracts\Transformers\Back\Resource;

use InetStudio\FAQ\Questions\Contracts\Models\QuestionModelContract;

/**
 * Interface IndexTransformerContract.
 */
interface IndexTransformerContract
{
    /**
     * Подготовка данных для отображения в таблице.
     *
     * @param  QuestionModelContract  $item
     *
     * @return array
     */
    public function transform(QuestionModelContract $item): array;
}
