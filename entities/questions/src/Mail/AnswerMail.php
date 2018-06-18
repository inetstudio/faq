<?php

namespace InetStudio\FAQ\Questions\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use InetStudio\FAQ\Questions\Contracts\Mail\AnswerMailContract;
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
    protected $question;

    /**
     * AnswerMail constructor.
     *
     * @param QuestionModelContract $question
     */
    public function __construct(QuestionModelContract $question)
    {
        $this->question = $question;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): self
    {
        $subject = config('app.name').' | '.((config('faq_questions.mails_users.subject')) ? config('faq_questions.mails_users.subject') : 'Ответ на вопрос');
        $headers = (config('faq_questions.mails_users.headers')) ? config('faq_questions.mails_users.headers') : [];

        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->to($this->question->email, $this->question->name)
            ->subject($subject)
            ->withSwiftMessage(function ($message) use ($headers) {
                $messageHeaders = $message->getHeaders();

                foreach ($headers as $header => $value) {
                    $messageHeaders->addTextHeader($header, $value);
                }
            })
            ->view('admin.module.faq.questions::mails.question_user', ['question' => $this->question]);
    }
}
