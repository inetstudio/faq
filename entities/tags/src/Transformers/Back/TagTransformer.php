<?php

namespace InetStudio\FAQ\Tags\Transformers\Back;

use League\Fractal\TransformerAbstract;
use InetStudio\FAQ\Tags\Contracts\Models\TagModelContract;
use InetStudio\FAQ\Tags\Contracts\Transformers\Back\TagTransformerContract;

/**
 * Class TagTransformer.
 */
class TagTransformer extends TransformerAbstract implements TagTransformerContract
{
    /**
     * Подготовка данных для отображения в таблице.
     *
     * @param TagModelContract $item
     *
     * @return array
     *
     * @throws \Throwable
     */
    public function transform(TagModelContract $item): array
    {
        return [
            'id' => (int) $item->id,
            'name' => $item->name,
            'created_at' => (string) $item->created_at,
            'updated_at' => (string) $item->updated_at,
            'actions' => view('admin.module.faq.tags::back.partials.datatables.actions', [
                'id' => $item->id,
            ])->render(),
        ];
    }
}
