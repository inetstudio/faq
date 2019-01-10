<?php

namespace InetStudio\FAQ\Questions\Http\Controllers\Back;

use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use InetStudio\FAQ\Questions\Contracts\Http\Controllers\Back\QuestionsExportControllerContract;

/**
 * Class QuestionsExportController.
 */
class QuestionsExportController extends Controller implements QuestionsExportControllerContract
{
    /**
     * Экспортируем вопросы.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportQuestions()
    {
        $export = app()->makeWith('InetStudio\FAQ\Questions\Contracts\Exports\QuestionsExportContract');

        return Excel::download($export, time().'.xlsx');
    }
}
