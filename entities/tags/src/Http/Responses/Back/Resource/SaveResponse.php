<?php

namespace InetStudio\FAQ\Tags\Http\Responses\Back\Resource;

use Illuminate\Http\Request;
use InetStudio\FAQ\Tags\Contracts\Models\TagModelContract;
use InetStudio\FAQ\Tags\Contracts\Http\Responses\Back\Resource\SaveResponseContract;

/**
 * Class SaveResponse.
 */
class SaveResponse implements SaveResponseContract
{
    /**
     * @var TagModelContract
     */
    protected $item;

    /**
     * SaveResponse constructor.
     *
     * @param  TagModelContract  $item
     */
    public function __construct(TagModelContract $item)
    {
        $this->item = $item;
    }

    /**
     * Возвращаем ответ при сохранении объекта.
     *
     * @param  Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function toResponse($request)
    {
        $item = $this->item->fresh();

        return response()->redirectToRoute(
            'back.faq.tags.edit',
            [
                $item['id'],
            ]
        );
    }
}
