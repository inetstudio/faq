@extends('admin::back.layouts.app')

@php
    $title = 'Вопросы';
@endphp

@section('title', $title)

@section('content')

    @push('breadcrumbs')
        @include('admin.module.faq.questions::back.partials.breadcrumbs.index')
    @endpush

    <div class="wrapper wrapper-content faq-questions-package" id="questions_table">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title table-group-buttons">
                        <a href="{{ route('back.faq.questions.create') }}" class="btn btn-xs btn-primary m-r-xl">Добавить</a>
                        <a href="#" data-url="{{ route('back.faq.questions.moderate.activity') }}" class="btn btn-xs btn-default">Изменить активность</a>
                        <a href="#" data-url="{{ route('back.faq.questions.moderate.read') }}" class="btn btn-xs btn-default">Отметить как прочитанное</a>
                        <a href="#" data-url="{{ route('back.faq.questions.moderate.destroy') }}" class="btn btn-xs btn-danger">Удалить</a>
                        <div class="ibox-tools">
                            <a href="{{ route('back.faq.questions.export') }}"
                               class="btn btn-sm btn-primary">Экспорт</a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="sk-spinner sk-spinner-double-bounce">
                            <div class="sk-double-bounce1"></div>
                            <div class="sk-double-bounce2"></div>
                        </div>
                        <div class="table-responsive">
                            {{ $table->table(['class' => 'table table-striped table-bordered table-hover dataTable']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@pushonce('scripts:datatables_faq_questions_index')
{!! $table->scripts() !!}
@endpushonce
