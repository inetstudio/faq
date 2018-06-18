<?php

namespace InetStudio\FAQ\Questions\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use InetStudio\FAQ\Tags\Models\Traits\HasTags;
use InetStudio\ACL\Users\Models\Traits\HasUser;
use InetStudio\Uploads\Models\Traits\HasImages;
use InetStudio\Persons\Models\Traits\HasPersons;
use InetStudio\Classifiers\Models\Traits\HasClassifiers;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use InetStudio\FAQ\Questions\Contracts\Models\QuestionModelContract;

/**
 * Class QuestionModel.
 */
class QuestionModel extends Model implements QuestionModelContract, HasMediaConversions
{
    use HasTags;
    use HasUser;
    use HasImages;
    use HasPersons;
    use Notifiable;
    use Searchable;
    use SoftDeletes;
    use HasClassifiers;

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
        $this->attributes['question'] = trim(str_replace("&nbsp;", '', strip_tags((isset($value['text'])) ? $value['text'] : $value)));
    }

    public function setAnswerAttribute($value)
    {
        $this->attributes['answer'] = trim(str_replace("&nbsp;", '', strip_tags($value['text'])));
    }

    /**
     * Настройка полей для поиска.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $arr = array_only($this->toArray(), ['id', 'question', 'answer']);

        return $arr;
    }

    /**
     * Обратное отношение с моделью персоны.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function person()
    {
        return $this->belongsTo(
            app()->make('InetStudio\Persons\Contracts\Models\PersonModelContract'),
            'person_id'
        );
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
}
