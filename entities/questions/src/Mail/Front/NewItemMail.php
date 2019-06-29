<?php

namespace InetStudio\FAQ\Questions\Mail\Front;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use InetStudio\FAQ\Questions\Contracts\Models\QuestionModelContract;
use InetStudio\FAQ\Questions\Contracts\Mail\Front\NewItemMailContract;

/**
 * Class NewItemMail.
 */
class NewItemMail extends Mailable implements NewItemMailContract
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
        $subject = config('app.name').' | '.config('faq_questions.mails_experts.subject', 'Новый вопрос');
        $headers = config('faq_questions.mails_experts.headers', []);

        $to = config('faq_questions.mails_experts.to') ?? $this->item->persons->first()->user->email;

        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->to($to, '')
            ->subject($subject)
            ->withSwiftMessage(function ($message) use ($headers) {
                $messageHeaders = $message->getHeaders();

                foreach ($headers as $header => $value) {
                    $messageHeaders->addTextHeader($header, $value);
                }
            })
            ->view('admin.module.faq.questions::mails.question_person', ['item' => $this->item]);
    }
}
