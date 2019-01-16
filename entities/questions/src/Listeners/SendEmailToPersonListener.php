<?php

namespace InetStudio\FAQ\Questions\Listeners;

use InetStudio\FAQ\Questions\Contracts\Listeners\SendEmailToPersonListenerContract;

/**
 * Class SendEmailToPersonListener.
 */
class SendEmailToPersonListener implements SendEmailToPersonListenerContract
{
    /**
     * Handle the event.
     *
     * @param object $event
     *
     * @return void
     */
    public function handle($event)
    {
        $question = $event->object;

        if (config('faq_questions.mails_persons.send')) {
            if (config('faq_questions.queue.enable')) {
                $queue = config('faq_questions.queue.name') ?? 'faq_questions_notify';

                $question->notify(
                    app()->makeWith('InetStudio\FAQ\Questions\Contracts\Notifications\NewQuestionQueueableNotificationContract', compact('question'))
                        ->onQueue($queue)
                );
            } else {
                $question->notify(
                    app()->makeWith('InetStudio\FAQ\Questions\Contracts\Notifications\NewQuestionNotificationContract', compact('question'))
                );
            }
        }
    }
}
