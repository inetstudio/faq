@extends('admin::back.layouts.app')

@php
    $title = 'Вопросы';
@endphp

@section('title', $title)

@section('content')

    @push('breadcrumbs')
        @include('admin.module.faq.questions::back.partials.breadcrumbs.index')
    @endpush

    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins faq-questions-package">
                    <div class="ibox-title">
                        <a href="{{ route('back.faq.questions.create') }}" class="btn btn-primary btn-sm">Добавить</a>
                        <div class="ibox-tools">
                            <a href="{{ route('back.faq.questions.export') }}" class="btn btn-sm btn-primary">Экспорт</a>
                        </div>
                    </div>
                    <div class="ibox-content">
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
