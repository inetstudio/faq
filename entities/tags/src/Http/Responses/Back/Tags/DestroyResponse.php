<?php

namespace InetStudio\FAQ\Tags\Http\Responses\Back\Tags;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Support\Responsable;
use InetStudio\FAQ\Tags\Contracts\Http\Responses\Back\Tags\DestroyResponseContract;

/**
 * Class DestroyResponse.
 */
class DestroyResponse implements DestroyResponseContract, Responsable
{
    /**
     * @var bool
     */
    private $result;

    /**
     * DestroyResponse constructor.
     *
     * @param bool $result
     */
    public function __construct(bool $result)
    {
        $this->result = $result;
    }

    /**
     * Возвращаем ответ при удалении объекта.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return JsonResponse
     */
    public function toResponse($request): JsonResponse
    {
        return response()->json([
            'success' => $this->result,
        ]);
    }
}
