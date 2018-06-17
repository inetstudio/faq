<?php

namespace InetStudio\FAQ\Tags\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use InetStudio\FAQ\Tags\Contracts\Models\TagModelContract;

/**
 * Class TagModel.
 */
class TagModel extends Model implements TagModelContract
{
    use SoftDeletes;

    /**
     * Связанная с моделью таблица.
     *
     * @var string
     */
    protected $table = 'faq_tags';

    /**
     * Атрибуты, для которых разрешено массовое назначение.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'title',
    ];

    /**
     * Атрибуты, которые должны быть преобразованы в даты.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Отношение "один ко многим" с моделью "ссылок" на материалы.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function taggables()
    {
        return $this->hasMany(app()->make('InetStudio\FAQ\Tags\Contracts\Models\TaggableModelContract'), 'tag_model_id');
    }
}
