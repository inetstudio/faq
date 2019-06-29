<?php

namespace InetStudio\FAQ\Questions\Exports;

use Illuminate\Database\Query\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\FAQ\Questions\Contracts\Exports\ItemsExportContract;

/**
 * Class ItemsExport.
 */
class ItemsExport implements ItemsExportContract, FromQuery, WithMapping, WithHeadings, WithColumnFormatting
{
    use Exportable;

    /**
     * @return Builder
     *
     * @throws BindingResolutionException
     */
    public function query()
    {
        $questionsService = app()->make(
            'InetStudio\FAQ\Questions\Contracts\Services\Back\ItemsServiceContract'
        );

        return $questionsService->getModel()->buildQuery(
            [
                'columns' => ['question', 'answer', 'created_at'],
                'relations' => ['persons'],
            ]
        );
    }

    /**
     * @param $question
     *
     * @return array
     */
    public function map($question): array
    {
        return [
            $question->id,
            Date::dateTimeToExcel($question->created_at),
            $question->name,
            $question->email,
            strip_tags($question->question),
            strip_tags($question->answer),
            ($question->persons->count() > 0) ? $question->persons->first()->name : '',
        ];
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Дата создания',
            'Имя',
            'Email',
            'Вопрос',
            'Ответ',
            'Эксперт',
        ];
    }

    /**
     * @return array
     */
    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_NUMBER,
            'B' => NumberFormat::FORMAT_DATE_DATETIME,
        ];
    }
}
