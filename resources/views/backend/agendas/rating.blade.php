@extends('backend.layouts.app')

@section('title', __('labels.backend.agendas.title').' | '.app_name())
@push('after-styles')
<style>
    table th {
        width: 20%;
    }
</style>
@endpush
@section('content')
    {!! Form::open(['method' => 'POST', 'route' => ['admin.agendas.store_rating'], 'files' => true,]) !!}

    <div class="card">

        <div class="card-header">
            <h3 class="page-title d-inline mb-0">@lang('labels.backend.agendas.rating')</h3>
{{--            <div class="float-right">--}}
{{--                <a href="{{ route('admin.students.index') }}"--}}
{{--                class="btn btn-success">@lang('labels.backend.students.view')</a>--}}
{{--            </div>--}}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 form-group">
                    {!! Form::label('teacher_rating',trans('labels.backend.agendas.teacher_rating'), ['class' => 'control-label']) !!}
                    {!! Form::input('number', 'teacher_rating', '', ['class' => 'form-control', 'multiple' => 'multiple','required' => true]) !!}
                </div>

                <div class="col-12 form-group">
                    {!! Form::label('teacher_comment',trans('labels.backend.agendas.teacher_comment'), ['class' => 'control-label']) !!}
                    {!! Form::input('text', 'teacher_comment', '', ['class' => 'form-control', 'multiple' => 'multiple','required' => true]) !!}
                </div>

                <div class="col-12 form-group">
                    {!! Form::label('course_rating',trans('labels.backend.agendas.course_rating'), ['class' => 'control-label']) !!}
                    {!! Form::input('number', 'course_rating', '', ['class' => 'form-control', 'multiple' => 'multiple','required' => true]) !!}
                </div>

                <div class="col-12 form-group">
                    {!! Form::label('course_comment',trans('labels.backend.agendas.course_comment'), ['class' => 'control-label']) !!}
                    {!! Form::input('text', 'course_comment', '', ['class' => 'form-control', 'multiple' => 'multiple','required' => true]) !!}
                </div>
                <input type="hidden" value="{{ $agenda->course_id }}" name="course_id">
                <input type="hidden" value="{{ $agenda->teacher_id }}" name="user_id">
            </div>

            <div class="row">
                <div class="col-12  text-center form-group">
                    {!! Form::submit(trans('labels.backend.agendas.rating'), ['class' => 'btn btn-danger']) !!}
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@stop
