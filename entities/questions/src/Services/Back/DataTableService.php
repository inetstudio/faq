<?php

namespace InetStudio\FAQ\Questions\Services\Back;

use Exception;
use Throwable;
use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\FAQ\Questions\Contracts\Models\QuestionModelContract;
use InetStudio\FAQ\Questions\Contracts\Services\Back\DataTableServiceContract;

/**
 * Class DataTableService.
 */
class DataTableService extends DataTable implements DataTableServiceContract
{
    /**
     * @var QuestionModelContract
     */
    protected $model;

    /**
     * DataTableService constructor.
     *
     * @param  QuestionModelContract  $model
     */
    public function __construct(QuestionModelContract $model)
    {
        $this->model = $model;
    }

    /**
     * Запрос на получение данных таблицы.
     *
     * @return JsonResponse
     *
     * @throws BindingResolutionException
     * @throws Exception
     */
    public function ajax(): JsonResponse
    {
        $transformer = app()->make('InetStudio\FAQ\Questions\Contracts\Transformers\Back\Resource\IndexTransformerContract');

        return DataTables::of($this->query())
            ->setTransformer($transformer)
            ->rawColumns(['read', 'active', 'actions'])
            ->make();
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = $this->model->buildQuery(
            [
                'columns' => ['is_read', 'question', 'created_at', 'updated_at'],
                'relations' => ['persons'],
            ]
        );

        return $query;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return Builder
     *
     * @throws Throwable
     */
    public function html(): Builder
    {
        /** @var Builder $table */
        $table = app('datatables.html');

        return $table
            ->columns($this->getColumns())
            ->ajax($this->getAjaxOptions())
            ->parameters($this->getParameters());
    }

    /**
     * Получаем колонки.
     *
     * @return array
     *
     * @throws Throwable
     */
    protected function getColumns(): array
    {
        return [
            ['data' => 'checkbox', 'name' => 'checkbox', 'title' => view('admin.module.faq.questions::back.partials.datatables.checkbox')
                ->render(), 'orderable' => false, 'searchable' => false, ],
            ['data' => 'read', 'name' => 'is_read', 'title' => 'Непрочитано', 'searchable' => false],
            ['data' => 'active', 'name' => 'is_active', 'title' => 'Активность', 'searchable' => false],
            ['data' => 'persons', 'name' => 'persons.name', 'title' => 'Эксперт'],
            ['data' => 'name', 'name' => 'name', 'title' => 'Имя'],
            ['data' => 'email', 'name' => 'email', 'title' => 'Email'],
            ['data' => 'question', 'name' => 'question', 'title' => 'Вопрос'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Дата создания'],
            ['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Дата обновления'],
            [
                'data' => 'actions',
                'name' => 'actions',
                'title' => 'Действия',
                'orderable' => false,
                'searchable' => false,
            ],
        ];
    }

    /**
     * Свойства ajax datatables.
     *
     * @return array
     */
    protected function getAjaxOptions(): array
    {
        return [
            'url' => route('back.faq.questions.data.index'),
            'type' => 'POST',
        ];
    }

    /**
     * Свойства datatables.
     *
     * @return array
     */
    protected function getParameters(): array
    {
        $translation = trans('admin::datatables');

        return [
            'order' => [7, 'desc'],
            'paging' => true,
            'pagingType' => 'full_numbers',
            'searching' => true,
            'info' => false,
            'searchDelay' => 350,
            'language' => $translation,
        ];
    }
}
