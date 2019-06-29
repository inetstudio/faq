<?php

namespace InetStudio\FAQ\Questions\Http\Responses\Back\Resource;

use Illuminate\Http\Request;
use InetStudio\FAQ\Questions\Contracts\Http\Responses\Back\Resource\FormResponseContract;

/**
 * Class FormResponse.
 */
class FormResponse implements FormResponseContract
{
    /**
     * @var array
     */
    protected $data;

    /**
     * FormResponse constructor.
     *
     * @param  array  $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Возвращаем ответ при открытии формы объекта.
     *
     * @param  Request  $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function toResponse($request)
    {
        return view('admin.module.faq.questions::back.pages.form', $this->data);
    }
}
