<?php

namespace InetStudio\FAQ\Tags\Http\Responses\Back\Tags;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Support\Responsable;
use InetStudio\FAQ\Tags\Contracts\Models\TagModelContract;
use InetStudio\FAQ\Tags\Contracts\Http\Responses\Back\Tags\ShowResponseContract;

/**
 * Class ShowResponse.
 */
class ShowResponse implements ShowResponseContract, Responsable
{
    /**
     * @var TagModelContract
     */
    private $item;

    /**
     * ShowResponse constructor.
     *
     * @param TagModelContract $item
     */
    public function __construct(TagModelContract $item)
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
