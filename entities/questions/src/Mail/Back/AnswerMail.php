<?php

namespace InetStudio\FAQ\Questions\Mail\Back;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use InetStudio\FAQ\Questions\Contracts\Mail\Back\AnswerMailContract;
use InetStudio\FAQ\Questions\Contracts\Models\QuestionModelContract;

/**
 * Class AnswerMail.
 */
class AnswerMail extends Mailable implements AnswerMailContract
{
    use SerializesModels;

    /**
     * @var QuestionModelContract
     */
    protected $item;

    /**
     * AnswerMail constructor.
     *
     * @param  QuestionModelContract  $item
     */
    public function __construct(QuestionModelContract $item)
    {
        $this->item = $item;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): self
    {
        $subject = config('app.name').' | '.config('faq_questions.mails_users.subject', 'Ответ на вопрос');
        $headers = config('faq_questions.mails_users.headers', []);

        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->to($this->item->email, $this->item->name)
            ->subject($subject)
            ->withSwiftMessage(function ($message) use ($headers) {
                $messageHeaders = $message->getHeaders();

                foreach ($headers as $header => $value) {
                    $messageHeaders->addTextHeader($header, $value);
                }
            })
            ->view('admin.module.faq.questions::mails.question_user', ['item' => $this->item]);
    }
}
