<?php

namespace InetStudio\FAQ\Questions\Http\Responses\Back\Questions;

use Illuminate\View\View;
use Illuminate\Contracts\Support\Responsable;
use InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Questions\IndexResponseContract;

/**
 * Class IndexResponse.
 */
class IndexResponse implements IndexResponseContract, Responsable
{
    /**
     * @var array
     */
    protected $data;

    /**
     * IndexResponse constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Возвращаем ответ при открытии списка объектов.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return View
     */
    public function toResponse($request): View
    {
        return view('admin.module.faq.questions::back.pages.index', $this->data);
    }
}
