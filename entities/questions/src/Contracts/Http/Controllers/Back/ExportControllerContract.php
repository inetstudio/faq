<?php

namespace InetStudio\FAQ\Questions\Contracts\Http\Controllers\Back;

use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Interface ExportControllerContract.
 */
interface ExportControllerContract
{
    /**
     * Выгружаем объекты.
     *
     * @return BinaryFileResponse
     */
    public function exportItems(): BinaryFileResponse;
}
