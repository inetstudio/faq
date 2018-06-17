<?php

namespace InetStudio\FAQ\Tags\Http\Responses\Back\Tags;

use Illuminate\Contracts\Support\Responsable;
use InetStudio\FAQ\Tags\Contracts\Models\TagModelContract;
use InetStudio\FAQ\Tags\Contracts\Http\Responses\Back\Tags\SaveResponseContract;

/**
 * Class SaveResponse.
 */
class SaveResponse implements SaveResponseContract, Responsable
{
    /**
     * @var TagModelContract
     */
    private $item;

    /**
     * SaveResponse constructor.
     *
     * @param TagModelContract $item
     */
    public function __construct(TagModelContract $item)
    {
        $this->item = $item;
    }

    /**
     * Возвращаем ответ при сохранении объекта.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function toResponse($request)
    {
        $this->item = $this->item->fresh();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'id' => $this->item->id,
            ], 200);
        } else {
            return response()->redirectToRoute('back.faq.tags.edit', [
                $this->item->id,
            ]);
        }
    }
}
