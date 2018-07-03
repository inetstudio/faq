<?php

namespace InetStudio\FAQ\Questions\Observers;

use InetStudio\FAQ\Questions\Contracts\Models\QuestionModelContract;
use InetStudio\FAQ\Questions\Contracts\Observers\QuestionObserverContract;

/**
 * Class QuestionObserver.
 */
class QuestionObserver implements QuestionObserverContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    public $services;

    /**
     * QuestionObserver constructor.
     */
    public function __construct()
    {
        $this->services['questionsObserver'] = app()->make(
            'InetStudio\FAQ\Questions\Contracts\Services\Back\QuestionsObserverServiceContract'
        );
    }

    /**
     * Событие "объект создается".
     *
     * @param QuestionModelContract $item
     */
    public function creating(QuestionModelContract $item): void
    {
        $this->services['questionsObserver']->creating($item);
    }

    /**
     * Событие "объект создан".
     *
     * @param QuestionModelContract $item
     */
    public function created(QuestionModelContract $item): void
    {
        $this->services['questionsObserver']->created($item);
    }

    /**
     * Событие "объект обновляется".
     *
     * @param QuestionModelContract $item
     */
    public function updating(QuestionModelContract $item): void
    {
        $this->services['questionsObserver']->updating($item);
    }

    /**
     * Событие "объект обновлен".
     *
     * @param QuestionModelContract $item
     */
    public function updated(QuestionModelContract $item): void
    {
        $this->services['questionsObserver']->updated($item);
    }

    /**
     * Событие "объект подписки удаляется".
     *
     * @param QuestionModelContract $item
     */
    public function deleting(QuestionModelContract $item): void
    {
        $this->services['questionsObserver']->deleting($item);
    }

    /**
     * Событие "объект удален".
     *
     * @param QuestionModelContract $item
     */
    public function deleted(QuestionModelContract $item): void
    {
        $this->services['questionsObserver']->deleted($item);
    }
}
