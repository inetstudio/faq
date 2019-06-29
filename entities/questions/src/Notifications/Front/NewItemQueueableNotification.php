<?php

namespace InetStudio\FAQ\Questions\Notifications\Front;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use InetStudio\FAQ\Questions\Contracts\Notifications\Front\NewItemQueueableNotificationContract;

/**
 * Class NewItemQueueableNotification.
 */
class NewItemQueueableNotification extends NewQuestionNotification implements ShouldQueue, NewItemQueueableNotificationContract
{
    use Queueable;
}
