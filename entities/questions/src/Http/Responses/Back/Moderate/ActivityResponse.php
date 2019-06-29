<?php

namespace InetStudio\FAQ\Questions\Http\Responses\Back\Moderate;

use Illuminate\Http\Request;
use InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Moderate\ActivityResponseContract;

/**
 * Class ActivityResponse.
 */
class ActivityResponse implements ActivityResponseContract
{
    /**
     * @var bool
     */
    protected $result;

    /**
     * ActivityResponse constructor.
     *
     * @param  bool  $result
     */
    public function __construct(bool $result)
    {
        $this->result = $result;
    }

    /**
     * Возвращаем ответ при изменении активности.
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
