<?php

namespace InetStudio\FAQ\Questions\Transformers\Back\Resource;

use Throwable;
use Illuminate\Support\Str;
use League\Fractal\TransformerAbstract;
use InetStudio\FAQ\Questions\Contracts\Models\QuestionModelContract;
use InetStudio\FAQ\Questions\Contracts\Transformers\Back\Resource\IndexTransformerContract;

/**
 * Class IndexTransformer.
 */
class IndexTransformer extends TransformerAbstract implements IndexTransformerContract
{
    /**
     * Подготовка данных для отображения в таблице.
     *
     * @param  QuestionModelContract  $item
     *
     * @return array
     *
     * @throws Throwable
     */
    public function transform(QuestionModelContract $item): array
    {
        return [
            'id' => (int) $item['id'],
            'checkbox' => view(
                'admin.module.faq.questions::back.partials.datatables.checkbox',
                [
                    'id' => $item['id'],
                ]
            )->render(),
            'read' => view(
                'admin.module.faq.questions::back.partials.datatables.read',
                [
                    'is_read' => $item['is_read'],
                ]
            )->render(),
            'active' => view(
                'admin.module.faq.questions::back.partials.datatables.active',
                [
                    'id' => $item['id'],
                    'is_active' => $item['is_active'],
                ]
            )->render(),
            'persons' => view(
                'admin.module.faq.questions::back.partials.datatables.persons',
                [
                    'persons' => $item['persons'],
                ]
            )->render(),
            'name' => $item['name'],
            'email' => $item['email'],
            'question' => Str::limit($item['question'], 150, '...'),
            'created_at' => (string) $item['created_at'],
            'updated_at' => (string) $item['updated_at'],
            'material' => view(
                'admin.module.faq.questions::back.partials.datatables.material',
                [
                    'item' => $item['faqable'],
                ]
            )->render(),
            'actions' => view(
                'admin.module.faq.questions::back.partials.datatables.actions',
                [
                    'id' => $item['id'],
                ]
            )->render(),
        ];
    }
}
