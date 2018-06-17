<?php

namespace InetStudio\FAQ\Questions\Services\Back;

use InetStudio\FAQ\Questions\Contracts\Models\QuestionModelContract;
use InetStudio\FAQ\Questions\Contracts\Repositories\QuestionsRepositoryContract;
use InetStudio\FAQ\Questions\Contracts\Services\Back\QuestionsObserverServiceContract;

/**
 * Class QuestionsObserverService.
 */
class QuestionsObserverService implements QuestionsObserverServiceContract
{
    /**
     * @var QuestionsRepositoryContract
     */
    private $repository;

    /**
     * QuestionsService constructor.
     *
     * @param QuestionsRepositoryContract $repository
     */
    public function __construct(QuestionsRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Событие "объект создается".
     *
     * @param QuestionModelContract $item
     */
    public function creating(QuestionModelContract $item): void
    {
    }

    /**
     * Событие "объект создан".
     *
     * @param QuestionModelContract $item
     */
    public function created(QuestionModelContract $item): void
    {
    }

    /**
     * Событие "объект обновляется".
     *
     * @param QuestionModelContract $item
     */
    public function updating(QuestionModelContract $item): void
    {
    }

    /**
     * Событие "объект обновлен".
     *
     * @param QuestionModelContract $item
     */
    public function updated(QuestionModelContract $item): void
    {
    }

    /**
     * Событие "объект подписки удаляется".
     *
     * @param QuestionModelContract $item
     */
    public function deleting(QuestionModelContract $item): void
    {
    }

    /**
     * Событие "объект удален".
     *
     * @param QuestionModelContract $item
     */
    public function deleted(QuestionModelContract $item): void
    {
    }
}
