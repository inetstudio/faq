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

    public $object;

    /**
     * SendQuestionEvent constructor.
     *
     * @param $object
     */
    public function __construct($object)
    {
        $this->object = $object;
    }
}
