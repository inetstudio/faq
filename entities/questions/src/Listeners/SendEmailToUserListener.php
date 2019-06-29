<?php

namespace InetStudio\FAQ\Questions\Listeners;

use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\FAQ\Questions\Contracts\Listeners\SendEmailToUserListenerContract;

/**
 * Class SendEmailToUserListener.
 */
class SendEmailToUserListener implements SendEmailToUserListenerContract
{
    /**
     * Handle the event.
     *
     * @param $event
     *
     * @throws BindingResolutionException
     */
    public function handle($event)
    {
        $item = $event->item;

        if (config('faq_questions.mails_users.send')) {
            if (config('faq_questions.queue.enable')) {
                $queue = config('faq_questions.queue.name') ?? 'faq_questions_notify';

                $item->notify(
                    app()->make(
                        'InetStudio\FAQ\Questions\Contracts\Notifications\Back\AnswerQueueableNotificationContract',
                        compact('item')
                    )->onQueue($queue)
                );
            } else {
                $item->notify(
                    app()->make('InetStudio\FAQ\Questions\Contracts\Notifications\Back\AnswerNotificationContract',
                        compact('item')
                    )
                );
            }
        }
    }
}
