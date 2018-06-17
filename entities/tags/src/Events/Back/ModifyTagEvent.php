<?php

namespace InetStudio\FAQ\Tags\Events\Back;

use Illuminate\Queue\SerializesModels;
use InetStudio\FAQ\Tags\Contracts\Models\TagModelContract;
use InetStudio\FAQ\Tags\Contracts\Events\Back\ModifyTagEventContract;

/**
 * Class ModifyTagEvent.
 */
class ModifyTagEvent implements ModifyTagEventContract
{
    use SerializesModels;

    public $tag;

    /**
     * ModifyTagEvent constructor.
     *
     * @param TagModelContract $tag
     */
    public function __construct(TagModelContract $tag)
    {
        $this->tag = $tag;
    }
}
