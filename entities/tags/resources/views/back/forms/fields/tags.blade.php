@inject('tagsService', 'InetStudio\FAQ\Tags\Contracts\Services\Back\ItemsServiceContract')

@php
    $item = $value;
@endphp

{!! Form::dropdown('faq_tags[]', $item->tags()->pluck('id')->toArray(), [
    'label' => [
        'title' => 'Теги',
    ],
    'field' => [
        'class' => 'select2-drop form-control',
        'data-placeholder' => 'Выберите теги',
        'style' => 'width: 100%',
        'multiple' => 'multiple',
        'data-source' => route('back.faq.tags.getSuggestions'),
        'data-exclude' => isset($attributes['exclude']) ? implode('|', $attributes['exclude']) : '',
    ],
    'options' => [
        'values' => (old('faq_tags')) ? $tagsService->getItemById(old('faq_tags'))->pluck('name', 'id')->toArray() : $item->tags()->pluck('name', 'id')->toArray(),
    ],
]) !!}
