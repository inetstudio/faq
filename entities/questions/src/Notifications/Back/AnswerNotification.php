<?php

namespace InetStudio\FAQ\Questions\Notifications\Back;

use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\FAQ\Questions\Contracts\Mail\Back\AnswerMailContract;
use InetStudio\FAQ\Questions\Contracts\Models\QuestionModelContract;
use InetStudio\FAQ\Questions\Contracts\Notifications\Back\AnswerNotificationContract;

/**
 * Class AnswerNotification.
 */
class AnswerNotification extends Notification implements AnswerNotificationContract
{
    protected $item;

    /**
     * AnswerNotification constructor.
     *
     * @param  QuestionModelContract  $item
     */
    public function __construct(QuestionModelContract $item)
    {
        $this->item = $item;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     *
     * @return array
     */
    public function via($notifiable): array
    {
        return [
            'mail',
            'database',
        ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param $notifiable
     *
     * @return AnswerMailContract
     *
     * @throws BindingResolutionException
     */
    public function toMail($notifiable): AnswerMailContract
    {
        return app()->make(
            AnswerMailContract::class,
            [
                'item' => $this->item,
            ]
        );
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     *
     * @return array
     */
    public function toDatabase($notifiable): array
    {
        return [
            'question_id' => $this->item->id,
        ];
    }
}
