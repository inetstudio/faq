<?php

namespace InetStudio\FAQ\Questions\Listeners;

use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\FAQ\Questions\Contracts\Listeners\SendEmailToPersonListenerContract;

/**
 * Class SendEmailToPersonListener.
 */
class SendEmailToPersonListener implements SendEmailToPersonListenerContract
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     *
     * @throws BindingResolutionException
     */
    public function handle($event): void
    {
        $item = $event->item;

        if (config('faq_questions.mails_persons.send')) {
            if (config('faq_questions.queue.enable')) {
                $queue = config('faq_questions.queue.name') ?? 'faq_questions_notify';

                $item->notify(
                    app()->make(
                        'InetStudio\FAQ\Questions\Contracts\Notifications\Front\NewItemQueueableNotificationContract',
                        compact('item')
                    )->onQueue($queue)
                );
            } else {
                $item->notify(
                    app()->make(
                        'InetStudio\FAQ\Questions\Contracts\Notifications\Front\NewItemNotificationContract',
                        compact('item')
                    )
                );
            }
        }
    }
}
