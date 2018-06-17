<?php

namespace InetStudio\FAQ\Questions\Events\Back;

use Illuminate\Queue\SerializesModels;
use InetStudio\FAQ\Questions\Contracts\Events\Back\ModifyQuestionEventContract;

/**
 * Class ModifyQuestionEvent.
 */
class ModifyQuestionEvent implements ModifyQuestionEventContract
{
    use SerializesModels;

    public $object;

    /**
     * ModifyQuestionEvent constructor.
     *
     * @param $object
     */
    public function __construct($object)
    {
        $this->object = $object;
    }
}
