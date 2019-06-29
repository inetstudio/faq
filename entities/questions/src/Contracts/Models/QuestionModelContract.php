<?php

namespace InetStudio\FAQ\Questions\Contracts\Models;

use OwenIt\Auditing\Contracts\Auditable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use InetStudio\AdminPanel\Base\Contracts\Models\BaseModelContract;
use InetStudio\Favorites\Contracts\Models\Traits\FavoritableContract;

/**
 * Interface QuestionModelContract.
 */
interface QuestionModelContract extends BaseModelContract, Auditable, FavoritableContract, HasMedia
{
}
