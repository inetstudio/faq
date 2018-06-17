<?php

namespace InetStudio\FAQ\Questions\Http\Responses\Back\Questions;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Support\Responsable;
use InetStudio\FAQ\Questions\Contracts\Models\QuestionModelContract;
use InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Questions\ShowResponseContract;

/**
 * Class ShowResponse.
 */
class ShowResponse implements ShowResponseContract, Responsable
{
    /**
     * @var QuestionModelContract
     */
    private $item;

    /**
     * ShowResponse constructor.
     *
     * @param QuestionModelContract $item
     */
    public function __construct(QuestionModelContract $item)
    {
        $this->item = $item;
    }

    /**
     * Возвращаем ответ при получении объекта.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return JsonResponse
     */
    public function toResponse($request): JsonResponse
    {
        return response()->json($this->item);
    }
}
