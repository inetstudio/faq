<?php

namespace InetStudio\FAQ\Tags\Http\Responses\Back\Resource;

use Illuminate\Http\Request;
use InetStudio\FAQ\Tags\Contracts\Models\TagModelContract;
use InetStudio\FAQ\Tags\Contracts\Http\Responses\Back\Resource\ShowResponseContract;

/**
 * Class ShowResponse.
 */
class ShowResponse implements ShowResponseContract
{
    /**
     * @var TagModelContract
     */
    protected $item;

    /**
     * ShowResponse constructor.
     *
     * @param  TagModelContract  $item
     */
    public function __construct(TagModelContract $item)
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
