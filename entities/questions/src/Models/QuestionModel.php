<?php

namespace InetStudio\FAQ\Questions\Models;

use Illuminate\Support\Arr;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use InetStudio\FAQ\Tags\Models\Traits\HasTags;
use InetStudio\ACL\Users\Models\Traits\HasUser;
use InetStudio\Uploads\Models\Traits\HasImages;
use InetStudio\Favorites\Models\Traits\Favoritable;
use InetStudio\PersonsPackage\Persons\Models\Traits\HasPersons;
use InetStudio\FAQ\Questions\Contracts\Models\QuestionModelContract;
use InetStudio\Favorites\Contracts\Models\Traits\FavoritableContract;
use InetStudio\AdminPanel\Base\Models\Traits\Scopes\BuildQueryScopeTrait;

/**
 * Class QuestionModel.
 */
class QuestionModel extends Model implements QuestionModelContract, HasMedia, FavoritableContract
{
    use HasTags;
    use HasUser;
    use HasImages;
    use HasPersons;
    use Notifiable;
    use Searchable;
    use Favoritable;
    use SoftDeletes;
    use BuildQueryScopeTrait;

    const ENTITY_TYPE = 'faq_question';

    protected $images = [
        'config' => 'faq_questions',
        'model' => 'question',
    ];

    /**
     * Связанная с моделью таблица.
     *
     * @var string
     */
    protected $table = 'faq_questions';

    /**
     * Атрибуты, для которых разрешено массовое назначение.
     *
     * @var array
     */
    protected $fillable = [
        'is_read', 'is_active', 'user_id', 'name', 'email', 'question', 'answer',
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
     * Загрузка модели.
     */
    protected static function boot()
    {
        parent::boot();

        self::$buildQueryScopeDefaults['columns'] = [
            'id', 'is_active', 'name', 'email',
        ];

        self::$buildQueryScopeDefaults['relations'] = [
            'persons' => function ($query) {
                $query->select(['id', 'name', 'slug']);
            },

            'tags' => function ($query) {
                $query->select(['id', 'name', 'title']);
            },
        ];
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strip_tags($value);
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strip_tags($value);
    }

    public function setQuestionAttribute($value)
    {
        $this->attributes['question'] = trim(str_replace("&nbsp;", ' ', strip_tags((isset($value['text'])) ? $value['text'] : (! is_array($value) ? $value : ''))));
    }

    public function setAnswerAttribute($value)
    {
        $this->attributes['answer'] = trim(str_replace("&nbsp;", ' ', (isset($value['text'])) ? $value['text'] : (! is_array($value) ? $value : '')));
    }

    /**
     * Настройка полей для поиска.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $arr = Arr::only($this->toArray(), ['id', 'question', 'answer']);

        $arr['tags'] = $this->tags->map(function ($item) {
            return Arr::only($item->toSearchableArray(), ['id', 'title']);
        })->toArray();

        return $arr;
    }

    /**
     * Заготовка запроса "Непрочитанные вопросы".
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', 0);
    }

    /**
     * Заготовка запроса "Активные вопросы".
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    /**
     * Заготовка запроса "Неактивные вопросы".
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopeInactive($query)
    {
        return $query->where('is_active', 0);
    }

    /**
     * Тип материала.
     *
     * @return string
     */
    public function getTypeAttribute()
    {
        return self::ENTITY_TYPE;
    }
}
