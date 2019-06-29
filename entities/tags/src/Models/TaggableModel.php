<?php

namespace InetStudio\FAQ\Tags\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\FAQ\Tags\Contracts\Models\TaggableModelContract;

/**
 * Class TaggableModel.
 */
class TaggableModel extends Model implements TaggableModelContract
{
    /**
     * Связанная с моделью таблица.
     *
     * @var string
     */
    protected $table = 'faq_taggables';

    /**
     * Атрибуты, для которых разрешено массовое назначение.
     *
     * @var array
     */
    protected $fillable = [
        'tag_model_id',
        'taggable_id',
        'taggable_type',
    ];

    /**
     * Атрибуты, которые должны быть преобразованы в даты.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * Обратное отношение "один ко многим" с моделью тега.
     *
     * @return BelongsTo
     *
     * @throws BindingResolutionException
     */
    public function tag()
    {
        $tagModel = app()->make('InetStudio\FAQ\Tags\Contracts\Models\TagModelContract');

        return $this->belongsTo(
            get_class($tagModel),
            'tag_model_id'
        );
    }
}
