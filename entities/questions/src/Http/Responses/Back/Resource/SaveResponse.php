<?php

namespace InetStudio\FAQ\Questions\Http\Responses\Back\Resource;

use Illuminate\Http\Request;
use InetStudio\FAQ\Questions\Contracts\Models\QuestionModelContract;
use InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Resource\SaveResponseContract;

/**
 * Class SaveResponse.
 */
class SaveResponse implements SaveResponseContract
{
    /**
     * @var QuestionModelContract
     */
    protected $item;

    /**
     * SaveResponse constructor.
     *
     * @param  QuestionModelContract  $item
     */
    public function __construct(QuestionModelContract $item)
    {
        $this->item = $item;
    }

    /**
     * Возвращаем ответ при сохранении объекта.
     *
     * @param  Request  $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function toResponse($request)
    {
        $item = $this->item->fresh();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'id' => $item['id'],
            ], 200);
        }

        return response()->redirectToRoute('back.faq.questions.edit', [
            $item['id'],
        ]);
    }
}
