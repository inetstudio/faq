<?php

namespace InetStudio\FAQ\Questions\Http\Responses\Back\Utility;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Support\Responsable;
use InetStudio\FAQ\Questions\Contracts\Models\QuestionModelContract;
use InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Utility\ActivityResponseContract;

/**
 * Class ActivityResponse.
 */
class ActivityResponse implements ActivityResponseContract, Responsable
{
    /**
     * @var QuestionModelContract
     */
    protected $item;

    /**
     * ActivityResponse constructor.
     *
     * @param QuestionModelContract $item
     */
    public function __construct(QuestionModelContract $item)
    {
        $this->item = $item;
    }

    /**
     * Возвращаем ответ при изменении активности.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return JsonResponse
     */
    public function toResponse($request): JsonResponse
    {
        return response()->json([
            'success' => (!! $this->item->id),
            'item' => $this->item,
        ]);
    }
}
