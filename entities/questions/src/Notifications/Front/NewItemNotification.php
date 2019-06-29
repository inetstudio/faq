<?php

namespace InetStudio\FAQ\Questions\Notifications\Front;

use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\FAQ\Questions\Contracts\Models\QuestionModelContract;
use InetStudio\FAQ\Questions\Contracts\Mail\Front\NewItemMailContract;
use InetStudio\FAQ\Questions\Contracts\Notifications\Front\NewItemNotificationContract;

/**
 * Class NewItemNotification.
 */
class NewItemNotification extends Notification implements NewItemNotificationContract
{
    /**
     * @var QuestionModelContract
     */
    protected $item;

    /**
     * NewItemNotification constructor.
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
     * @return NewItemMailContract
     *
     * @throws BindingResolutionException
     */
    public function toMail($notifiable): NewItemMailContract
    {
        return app()->make(
            NewItemMailContract::class,
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
