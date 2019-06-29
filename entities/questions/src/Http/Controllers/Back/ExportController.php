<?php

namespace InetStudio\FAQ\Questions\Http\Controllers\Back;

use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use InetStudio\AdminPanel\Base\Http\Controllers\Controller;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\FAQ\Questions\Contracts\Http\Controllers\Back\ExportControllerContract;

/**
 * Class ExportController.
 */
class ExportController extends Controller implements ExportControllerContract
{
    /**
     * Выгружаем объекты.
     *
     * @return BinaryFileResponse
     *
     * @throws BindingResolutionException
     */
    public function exportItems(): BinaryFileResponse
    {
        $export = app()->make('InetStudio\FAQ\Questions\Contracts\Exports\ItemsExportContract');

        return Excel::download($export, time().'.xlsx');
    }
}
