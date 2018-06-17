<?php

namespace InetStudio\FAQ\Questions\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use InetStudio\FAQ\Questions\Contracts\Notifications\NewQuestionQueueableNotificationContract;

/**
 * Class NewQuestionQueueableNotification.
 */
class NewQuestionQueueableNotification extends NewQuestionNotification implements ShouldQueue, NewQuestionQueueableNotificationContract
{
    use Queueable;
}
