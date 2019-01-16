<?php

namespace InetStudio\FAQ\Questions\Listeners;

use InetStudio\FAQ\Questions\Contracts\Listeners\SendEmailToUserListenerContract;

/**
 * Class SendEmailToUserListener.
 */
class SendEmailToUserListener implements SendEmailToUserListenerContract
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

        if (config('faq_questions.mails_users.send')) {
            if (config('faq_questions.queue.enable')) {
                $queue = config('faq_questions.queue.name') ?? 'faq_questions_notify';

                $question->notify(
                    app()->makeWith('InetStudio\FAQ\Questions\Contracts\Notifications\AnswerQueueableNotificationContract', compact('question'))
                        ->onQueue($queue)
                );
            } else {
                $question->notify(
                    app()->makeWith('InetStudio\FAQ\Questions\Contracts\Notifications\AnswerNotificationContract', compact('question'))
                );
            }
        }
    }
}
