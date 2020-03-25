<?php

namespace InetStudio\FAQ\Questions\Models;

use Illuminate\Support\Arr;
use Laravel\Scout\Searchable;
use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use InetStudio\FAQ\Tags\Models\Traits\HasTags;
use InetStudio\ACL\Users\Models\Traits\HasUser;
use InetStudio\Uploads\Models\Traits\HasImages;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use InetStudio\PersonsPackage\Persons\Models\Traits\HasPersons;
use InetStudio\AdminPanel\Base\Models\Traits\HasDynamicRelations;
use InetStudio\FAQ\Questions\Contracts\Models\QuestionModelContract;
use InetStudio\AdminPanel\Base\Models\Traits\Scopes\BuildQueryScopeTrait;

/**
 * Class QuestionModel.
 */
class QuestionModel extends Model implements QuestionModelContract
{
    use HasTags;
    use HasUser;
    use Auditable;
    use HasImages;
    use HasPersons;
    use Notifiable;
    use Searchable;
    use SoftDeletes;
    use HasDynamicRelations;
    use BuildQueryScopeTrait;

    /**
     * Тип сущности.
     */
    const ENTITY_TYPE = 'faq_question';

    /**
     * Should the timestamps be audited?
     *
     * @var bool
     */
    protected $auditTimestamps = true;

    /**
     * Настройки для генерации изображений.
     *
     * @var array
     */
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
        'is_read',
        'is_active',
        'user_id',
        'name',
        'email',
        'question',
        'answer',
        'faqable_type',
        'faqable_id',
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
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableIndex()
    {
        return trim(config('scout.elasticsearch.index', '').'_faq', '_');
    }

    /**
     * Get the _type name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return '_doc';
    }

    /**
     * Загрузка модели.
     */
    protected static function boot()
    {
        parent::boot();

        self::$buildQueryScopeDefaults['columns'] = [
            'id',
            'is_active',
            'name',
            'email',
            'faqable_type',
            'faqable_id',
        ];

        self::$buildQueryScopeDefaults['relations'] = [
            'tags' => function ($query) {
                $query->select(['id', 'name', 'title']);
            },

            'persons' => function ($query) {
                $query->select(['id', 'name', 'slug'])
                    ->with(['media' => function ($query) {
                        $query->select(['id', 'model_id', 'model_type', 'collection_name', 'file_name', 'disk', 'conversions_disk', 'uuid', 'mime_type', 'custom_properties']);
                    }]);
            },
        ];
    }

    /**
     * Сеттер атрибута is_read.
     *
     * @param $value
     */
    public function setIsReadAttribute($value)
    {
        $this->attributes['is_read'] = (bool) trim(strip_tags($value));
    }

    /**
     * Сеттер атрибута is_active.
     *
     * @param $value
     */
    public function setIsActiveAttribute($value)
    {
        $this->attributes['is_active'] = (bool) trim(strip_tags($value));
    }

    /**
     * Сеттер атрибута user_id.
     *
     * @param $value
     */
    public function setUserIdAttribute($value)
    {
        $this->attributes['user_id'] = (int) trim(strip_tags($value));
    }

    /**
     * Сеттер атрибута name.
     *
     * @param $value
     */
    public function setNameAttribute($value): void
    {
        $this->attributes['name'] = strip_tags($value);
    }

    /**
     * Сеттер атрибута email.
     *
     * @param $value
     */
    public function setEmailAttribute($value): void
    {
        $this->attributes['email'] = strip_tags($value);
    }

    /**
     * Сеттер атрибута question.
     *
     * @param $value
     */
    public function setQuestionAttribute($value): void
    {
        $value = (isset($value['text'])) ? $value['text'] : (! is_array($value) ? $value : '');

        $this->attributes['question'] = trim(str_replace('&nbsp;', ' ', strip_tags($value)));
    }

    /**
     * Сеттер атрибута answer.
     *
     * @param $value
     */
    public function setAnswerAttribute($value): void
    {
        $value = (isset($value['text'])) ? $value['text'] : (! is_array($value) ? $value : '');

        $this->attributes['answer'] = trim(str_replace('&nbsp;', ' ', $value));
    }

    /**
     * Сеттер атрибута faqable_type.
     *
     * @param $value
     */
    public function setFaqableTypeAttribute($value): void
    {
        $this->attributes['faqable_type'] = trim(strip_tags($value));
    }

    /**
     * Сеттер атрибута faqable_id.
     *
     * @param $value
     */
    public function setFaqableIdAttribute($value): void
    {
        $this->attributes['faqable_id'] = (int) trim(strip_tags($value));
    }

    /**
     * Геттер атрибута type.
     *
     * @return string
     */
    public function getTypeAttribute(): string
    {
        return self::ENTITY_TYPE;
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
     * Полиморфное отношение с остальными моделями.
     *
     * @return MorphTo
     */
    public function faqable(): MorphTo
    {
        return $this->morphTo();
    }
}
