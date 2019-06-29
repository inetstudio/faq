<?php

namespace InetStudio\FAQ\Tags\Events\Back;

use Illuminate\Queue\SerializesModels;
use InetStudio\FAQ\Tags\Contracts\Models\TagModelContract;
use InetStudio\FAQ\Tags\Contracts\Events\Back\ModifyItemEventContract;

/**
 * Class ModifyItemEvent.
 */
class ModifyItemEvent implements ModifyItemEventContract
{
    use SerializesModels;

    /**
     * @var TagModelContract
     */
    public $item;

    /**
     * ModifyItemEvent constructor.
     *
     * @param TagModelContract $item
     */
    public function __construct(TagModelContract $item)
    {
        $this->item = $item;
    }
}
