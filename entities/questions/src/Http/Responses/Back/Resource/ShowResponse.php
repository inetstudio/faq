<?php

namespace InetStudio\FAQ\Questions\Http\Responses\Back\Resource;

use Illuminate\Http\Request;
use InetStudio\FAQ\Questions\Contracts\Models\QuestionModelContract;
use InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Resource\ShowResponseContract;

/**
 * Class ShowResponse.
 */
class ShowResponse implements ShowResponseContract
{
    /**
     * @var QuestionModelContract
     */
    protected $item;

    /**
     * ShowResponse constructor.
     *
     * @param  QuestionModelContract  $item
     */
    public function __construct(QuestionModelContract $item)
    {
        $this->item = $item;
    }

    /**
     * Возвращаем ответ при получении объекта.
     *
     * @param  Request  $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function toResponse($request)
    {
        return response()->json($this->item);
    }
}
