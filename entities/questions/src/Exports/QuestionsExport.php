<?php

namespace InetStudio\FAQ\Questions\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use InetStudio\FAQ\Questions\Contracts\Exports\QuestionsExportContract;

/**
 * Class QuestionsExport.
 */
class QuestionsExport implements QuestionsExportContract, FromQuery, WithMapping, WithHeadings, WithColumnFormatting
{
    use Exportable;

    /**
     * @var
     */
    protected $questionsRepository;

    /**
     * QuestionsExport constructor.
     */
    public function __construct()
    {
        $this->questionsRepository = app()->make('InetStudio\FAQ\Questions\Contracts\Repositories\QuestionsRepositoryContract');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder
     */
    public function query()
    {
        return $this->questionsRepository->getItemsQuery([
            'columns' => ['question', 'answer', 'created_at'],
            'relations' => ['persons'],
        ]);
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
