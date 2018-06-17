<?php

namespace InetStudio\FAQ\Questions\Notifications;

use Illuminate\Notifications\Notification;
use InetStudio\FAQ\Questions\Contracts\Mail\NewQuestionMailContract;
use InetStudio\FAQ\Questions\Contracts\Models\QuestionModelContract;
use InetStudio\FAQ\Questions\Contracts\Notifications\NewQuestionNotificationContract;

/**
 * Class NewQuestionNotification.
 */
class NewQuestionNotification extends Notification implements NewQuestionNotificationContract
{
    protected $question;

    /**
     * NewCommentNotification constructor.
     *
     * @param QuestionModelContract $question
     */
    public function __construct(QuestionModelContract $question)
    {
        $this->question = $question;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return [
            'mail', 'database',
        ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param $notifiable
     * @return NewQuestionMailContract
     */
    public function toMail($notifiable): NewQuestionMailContract
    {
        return app()->makeWith('InetStudio\FAQ\Questions\Contracts\Models\QuestionModelContract', [
            'question' => $this->question,
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toDatabase($notifiable): array
    {
        return [
            'question_id' => $this->question->id,
        ];
    }
}
