<?php

namespace InetStudio\FAQ\Questions\Services\Front;

use Illuminate\Support\Arr;
use InetStudio\AdminPanel\Base\Services\BaseService;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\FAQ\Tags\Services\Front\Traits\TagsServiceTrait;
use InetStudio\FAQ\Questions\Contracts\Models\QuestionModelContract;
use InetStudio\Favorites\Services\Front\Traits\FavoritesServiceTrait;
use InetStudio\FAQ\Questions\Contracts\Services\Front\ItemsServiceContract;

/**
 * Class ItemsService.
 */
class ItemsService extends BaseService implements ItemsServiceContract
{
    use TagsServiceTrait;
    use FavoritesServiceTrait;

    /**
     * @var string
     */
    protected $favoritesType = 'faq_question';

    /**
     * ItemsService constructor.
     *
     * @param  QuestionModelContract  $model
     */
    public function __construct(QuestionModelContract $model)
    {
        parent::__construct($model);
    }

    /**
     * Сохраняем вопрос.
     *
     * @param  array  $data
     *
     * @return array
     *
     * @throws BindingResolutionException
     */
    public function save(array $data): array
    {
        $usersService = app()->make('InetStudio\ACL\Users\Contracts\Services\Front\UsersServiceContract');

        $user = $usersService->getUser();

        $item = $this->saveModel([
            'is_read' => 0,
            'is_active' => 0,
            'user_id' => $user->id ?? 0,
            'name' => $user->name ?? $data['name'],
            'email' => $user->email ?? $data['email'],
            'question' => $data['question'],
        ], 0);

        $result = ($item && $item['id']);

        if ($result) {
            $personsData = Arr::get($data, 'persons', []);
            app()->make('InetStudio\PersonsPackage\Persons\Contracts\Services\Back\ItemsServiceContract')
                ->attachToObject($personsData, $item);

            event(
                app()->makeWith(
                    'InetStudio\FAQ\Questions\Contracts\Events\Front\SendItemEventContract',
                    compact('item')
                )
            );
        }

        return [
            'success' => $result,
            'message' => ($result)
                ? trans('admin.module.faq.questions::questions.send_success')
                : trans('admin.module.faq.questions::questions.send_fail'),
        ];
    }

    /**
     * Получаем активные вопросы.
     *
     * @param  array  $params
     *
     * @return mixed
     */
    public function getActiveItems(array $params = [])
    {
        return $this->model::buildQuery($params)->active();
    }

    /**
     * Возвращаем используемые теги.
     *
     * @param  array  $params
     *
     * @return mixed
     */
    public function getItemsTags(array $params = [])
    {
        $items = $this->getActiveItems(array_merge([
            'relations' => ['tags'],
        ], $params))->get();

        return $items->map(function ($item) {
            return $item->tags;
        })->collapse()->unique('id');
    }
}
