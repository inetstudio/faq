<?php

namespace InetStudio\FAQ\Questions\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use InetStudio\FAQ\Questions\Contracts\Mail\NewQuestionMailContract;
use InetStudio\FAQ\Questions\Contracts\Models\QuestionModelContract;

/**
 * Class NewQuestionMail.
 */
class NewQuestionMail extends Mailable implements NewQuestionMailContract
{
    use SerializesModels;

    protected $question;

    /**
     * NewQuestionMail constructor.
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
        $subject = config('app.name').' | '.((config('faq_questions.mails.subject')) ? config('faq_questions.mails.subject') : 'Новый вопрос');
        $headers = (config('faq_questions.mails.headers')) ? config('faq_questions.mails.headers') : [];

        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->to(config('faq_questions.mails.to'), '')
            ->subject($subject)
            ->withSwiftMessage(function ($message) use ($headers) {
                $messageHeaders = $message->getHeaders();

                foreach ($headers as $header => $value) {
                    $messageHeaders->addTextHeader($header, $value);
                }
            })
            ->view('admin.module.faq.questions::mails.question_expert', ['question' => $this->question]);
    }
}
