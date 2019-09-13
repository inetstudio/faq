<?php

namespace InetStudio\FAQ\Questions\Notifications\Back;

use Illuminate\Bus\Queueable;
use InetStudio\FAQ\Questions\Contracts\Notifications\Back\AnswerQueueableNotificationContract;

/**
 * Class AnswerQueueableNotification.
 */
class AnswerQueueableNotification extends AnswerNotification implements AnswerQueueableNotificationContract
{
    use Queueable;
}
