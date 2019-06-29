<?php

namespace InetStudio\FAQ\Questions\Events\Back;

use Illuminate\Queue\SerializesModels;
use InetStudio\FAQ\Questions\Contracts\Models\QuestionModelContract;
use InetStudio\FAQ\Questions\Contracts\Events\Back\ModifyItemActivityEventContract;

/**
 * Class ModifyItemActivityEvent.
 */
class ModifyItemActivityEvent implements ModifyItemActivityEventContract
{
    use SerializesModels;

    /**
     * @var QuestionModelContract
     */
    public $item;

    /**
     * ModifyItemActivityEvent constructor.
     *
     * @param  QuestionModelContract  $item
     */
    public function __construct(QuestionModelContract $item)
    {
        $this->item = $item;
    }
}
