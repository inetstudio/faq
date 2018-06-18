<?php

namespace InetStudio\FAQ\Questions\Events\Front;

use Illuminate\Queue\SerializesModels;
use InetStudio\FAQ\Questions\Contracts\Events\Front\SendQuestionEventContract;

/**
 * Class SendQuestionEvent.
 */
class SendQuestionEvent implements SendQuestionEventContract
{
    use SerializesModels;

    public $question;

    /**
     * SendQuestionEvent constructor.
     *
     * @param $question
     */
    public function __construct($question)
    {
        $this->question = $question;
    }
}
