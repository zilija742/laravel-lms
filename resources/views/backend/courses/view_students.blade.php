@extends('backend.layouts.app')
@section('title', __('labels.backend.courses.title').' | '.app_name())

@section('content')

    {!! Form::model($course, ['method' => 'POST', 'route' => ['admin.courses.add_students', $course->id], 'files' => true,]) !!}

    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0">@lang('labels.backend.courses.add_students')</h3>
            <div class="float-right">
                <a href="{{ route('admin.courses.index') }}"
                   class="btn btn-success">@lang('labels.backend.courses.view')</a>
            </div>
        </div>

        <div class="card-body">

                <div class="row">

                    <div class="col-12 form-group">
                        {!! Form::label('students',trans('labels.backend.courses.fields.students'), ['class' => 'control-label']) !!}
                        {!! Form::select('students[]', $students, old('students') ? old('students') : $course->students->pluck('id')->toArray(), ['class' => 'form-control select2', 'multiple' => 'multiple','required' => true]) !!}
                    </div>
{{--                    <div class="col-2 d-flex form-group flex-column">--}}
{{--                        OR <a target="_blank" class="btn btn-primary mt-auto"--}}
{{--                              href="{{route('admin.teachers.create')}}">{{trans('labels.backend.courses.add_teachers')}}</a>--}}
{{--                    </div>--}}
                </div>



            <div class="row">
                <div class="col-12  text-center form-group">
                    {!! Form::submit(trans('strings.backend.general.app_update'), ['class' => 'btn btn-danger']) !!}
                </div>
            </div>
        </div>
    </div>

    {!! Form::close() !!}
@stop

@push('after-scripts')

@endpush
