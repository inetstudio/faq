<?php

namespace InetStudio\FAQ\Questions\Http\Responses\Back\Questions;

use Illuminate\Contracts\Support\Responsable;
use InetStudio\FAQ\Questions\Contracts\Models\QuestionModelContract;
use InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Questions\SaveResponseContract;

/**
 * Class SaveResponse.
 */
class SaveResponse implements SaveResponseContract, Responsable
{
    /**
     * @var QuestionModelContract
     */
    protected $item;

    /**
     * SaveResponse constructor.
     *
     * @param QuestionModelContract $item
     */
    public function __construct(QuestionModelContract $item)
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
            return response()->redirectToRoute('back.faq.questions.edit', [
                $this->item->id,
            ]);
        }
    }
}
