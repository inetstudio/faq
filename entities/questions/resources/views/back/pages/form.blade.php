@extends('admin::back.layouts.app')

@php
    $title = ($item->id) ? 'Просмотр вопроса' : 'Редактирование вопроса';
@endphp

@section('title', $title)

@section('content')

    @push('breadcrumbs')
        @include('admin.module.faq.questions::back.partials.breadcrumbs.form')
    @endpush

    <div class="row m-sm">
        <a class="btn btn-white" href="{{ route('back.faq.questions.index') }}">
            <i class="fa fa-arrow-left"></i> Вернуться назад
        </a>
        @if ($item->id && $item->href)
            <a class="btn btn-white" href="{{ $item->href }}" target="_blank">
                <i class="fa fa-eye"></i> Посмотреть на сайте
            </a>
        @endif
    </div>

    <div class="wrapper wrapper-content">

        {!! Form::info() !!}

        {!! Form::open(['url' => (! $item->id) ? route('back.faq.questions.store') : route('back.faq.questions.update', [$item->id]), 'id' => 'mainForm', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal']) !!}

            @if ($item->id)
                {{ method_field('PUT') }}
            @endif

            {!! Form::hidden('question_id', (! $item->id) ? '' : $item->id, ['id' => 'object-id']) !!}

            {!! Form::hidden('question_type', get_class($item), ['id' => 'object-type']) !!}

            {!! Form::buttons('', '', ['back' => 'back.faq.questions.index']) !!}

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel-group float-e-margins" id="mainAccordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#mainAccordion" href="#collapseMain" aria-expanded="true">Основная информация</a>
                                </h5>
                            </div>
                            <div id="collapseMain" class="panel-collapse collapse in" aria-expanded="true">
                                <div class="panel-body">

                                    {!! Form::string('name', $item->name, [
                                        'label' => [
                                            'title' => 'Имя',
                                        ],
                                        'field' => [
                                            'class' => 'form-control',
                                            'disabled' => (!! $item->name),
                                        ],
                                    ]) !!}

                                    {!! Form::string('email', $item->email, [
                                        'label' => [
                                            'title' => 'Email',
                                        ],
                                        'field' => [
                                            'class' => 'form-control',
                                            'disabled' => (!! $item->email),
                                        ],
                                    ]) !!}

                                    {!! Form::classifiers('', $item, [
                                        'label' => [
                                            'title' => 'Тип кожи',
                                        ],
                                        'field' => [
                                            'placeholder' => 'Выберите типы кожи',
                                            'type' => 'Тип кожи',
                                        ],
                                    ]) !!}

                                    {!! Form::wysiwyg('question', $item->question, [
                                        'label' => [
                                            'title' => 'Вопрос',
                                        ],
                                        'field' => [
                                            'class' => 'tinymce-simple',
                                            'type' => 'simple',
                                            'id' => 'question',
                                        ],
                                    ]) !!}

                                    {!! Form::persons('', $item, [
                                        'label' => 'Эксперты',
                                        'placeholder' => 'Выберите экспертов',
                                    ]) !!}

                                    {!! Form::wysiwyg('answer', $item->answer, [
                                        'label' => [
                                            'title' => 'Ответ',
                                        ],
                                        'field' => [
                                            'class' => 'tinymce',
                                            'id' => 'answer',
                                            'hasImages' => true,
                                        ],
                                        'images' => [
                                            'media' => $item->getMedia('answer'),
                                            'fields' => [
                                                [
                                                    'title' => 'Описание',
                                                    'name' => 'description',
                                                ],
                                                [
                                                    'title' => 'Copyright',
                                                    'name' => 'copyright',
                                                ],
                                                [
                                                    'title' => 'Alt',
                                                    'name' => 'alt',
                                                ],
                                            ],
                                        ],
                                    ]) !!}

                                    {!! Form::faq_tags('', $item) !!}

                                    {!! Form::radios('is_active', (! $item->id) ? 1 : $item->is_active, [
                                        'label' => [
                                            'title' => 'Отображать на сайте',
                                        ],
                                        'radios' => [
                                            [
                                                'label' => 'Да',
                                                'value' => 1,
                                                'options' => [
                                                    'class' => 'i-checks',
                                                ],
                                            ],
                                            [
                                                'label' => 'Нет',
                                                'value' => 0,
                                                'options' => [
                                                    'class' => 'i-checks',
                                                ],
                                            ]
                                        ],
                                    ]) !!}

                                    {!! Form::hidden('is_read', 1) !!}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {!! Form::buttons('', '', ['back' => 'back.faq.questions.index']) !!}

        {!! Form::close()!!}

    </div>
@endsection
