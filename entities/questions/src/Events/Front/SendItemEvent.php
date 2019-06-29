<?php

namespace InetStudio\FAQ\Questions\Events\Front;

use Illuminate\Queue\SerializesModels;
use InetStudio\FAQ\Questions\Contracts\Models\QuestionModelContract;
use InetStudio\FAQ\Questions\Contracts\Events\Front\SendItemEventContract;

/**
 * Class SendItemEvent.
 */
class SendItemEvent implements SendItemEventContract
{
    use SerializesModels;

    /**
     * @var QuestionModelContract
     */
    public $item;

    /**
     * SendItemEvent constructor.
     *
     * @param  QuestionModelContract  $item
     */
    public function __construct(QuestionModelContract $item)
    {
        $this->item = $item;
    }
}
