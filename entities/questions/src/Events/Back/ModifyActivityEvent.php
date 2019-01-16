<?php

namespace InetStudio\FAQ\Questions\Events\Back;

use Illuminate\Queue\SerializesModels;
use InetStudio\FAQ\Questions\Contracts\Events\Back\ModifyActivityEventContract;

/**
 * Class ModifyActivityEvent.
 */
class ModifyActivityEvent implements ModifyActivityEventContract
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
