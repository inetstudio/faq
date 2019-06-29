<?php

namespace InetStudio\FAQ\Questions\Notifications\Back;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use InetStudio\FAQ\Questions\Contracts\Notifications\Back\AnswerQueueableNotificationContract;

/**
 * Class AnswerQueueableNotification.
 */
class AnswerQueueableNotification extends AnswerNotification implements ShouldQueue, AnswerQueueableNotificationContract
{
    use Queueable;
}
