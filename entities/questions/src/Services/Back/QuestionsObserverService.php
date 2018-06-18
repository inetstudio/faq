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
        if (config('faq_questions.mails_experts.to')) {
            if (config('faq_questions.queue.enable')) {
                $queue = config('faq_questions.queue.name') ?? 'faq_questions_notify';

                $item->notify(
                    app()->makeWith('InetStudio\FAQ\Questions\Contracts\Notifications\NewQuestionQueueableNotificationContract', [
                        'question' => $item,
                    ])->onQueue($queue)
                );
            } else {
                $item->notify(
                    app()->makeWith('InetStudio\FAQ\Questions\Contracts\Notifications\NewQuestionNotificationContract', [
                        'question' => $item,
                    ])
                );
            }
        }
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
        if ($item->is_active == 1 && $item->getOriginal('is_active') !== $item->is_active && $item->email) {
            if (config('faq_questions.queue.enable')) {
                $queue = config('faq_questions.queue.name') ?? 'faq_questions_notify';

                $item->notify(
                    app()->makeWith('InetStudio\FAQ\Questions\Contracts\Notifications\AnswerQueueableNotificationContract', [
                        'question' => $item,
                    ])->onQueue($queue)
                );
            } else {
                $item->notify(
                    app()->makeWith('InetStudio\FAQ\Questions\Contracts\Notifications\AnswerNotificationContract', [
                        'question' => $item,
                    ])
                );
            }
        }
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
