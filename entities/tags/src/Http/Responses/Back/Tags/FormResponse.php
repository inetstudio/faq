<?php

namespace InetStudio\FAQ\Tags\Http\Responses\Back\Tags;

use Illuminate\View\View;
use Illuminate\Contracts\Support\Responsable;
use InetStudio\FAQ\Tags\Contracts\Http\Responses\Back\Tags\FormResponseContract;

/**
 * Class FormResponse.
 */
class FormResponse implements FormResponseContract, Responsable
{
    /**
     * @var array
     */
    protected $data;

    /**
     * FormResponse constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Возвращаем ответ при открытии формы объекта.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return View
     */
    public function toResponse($request): View
    {
        return view('admin.module.faq.tags::back.pages.form', $this->data);
    }
}
