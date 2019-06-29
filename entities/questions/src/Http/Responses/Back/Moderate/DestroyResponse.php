<?php

namespace InetStudio\FAQ\Questions\Http\Responses\Back\Moderate;

use Illuminate\Http\Request;
use InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Moderate\DestroyResponseContract;

/**
 * Class DestroyResponse.
 */
class DestroyResponse implements DestroyResponseContract
{
    /**
     * @var bool
     */
    protected $result;

    /**
     * DestroyResponse constructor.
     *
     * @param  bool  $result
     */
    public function __construct(bool $result)
    {
        $this->result = $result;
    }

    /**
     * Возвращаем ответ при удалении объектов.
     *
     * @param  Request  $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function toResponse($request)
    {
        return response()->json(
            [
                'success' => $this->result,
            ]
        );
    }
}
