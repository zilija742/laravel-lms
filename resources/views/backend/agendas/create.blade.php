@extends('backend.layouts.app')
@section('title', __('labels.backend.agendas.title').' | '.app_name())

@section('content')

    {!! Form::open(['method' => 'POST', 'route' => ['admin.agendas.store'], 'files' => true]) !!}

    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left">@lang('labels.backend.agendas.create')</h3>
            <div class="float-right">
                <a href="{{ route('admin.agendas.index') }}"
                   class="btn btn-success">@lang('labels.backend.agendas.view')</a>
            </div>
        </div>

        <div class="card-body">

            <div class="row">
                <div class="col-10 form-group">
                    {!! Form::label('company_id',trans('labels.backend.agendas.fields.company'), ['class' => 'control-label']) !!}
                    {!! Form::select('company_id', $companies, old('company_id'), ['class' => 'form-control select2 js-example-placeholder-single', 'multiple' => false, 'required' => true]) !!}
                </div>
                <div class="col-2 d-flex form-group flex-column">
                    OR <a target="_blank" class="btn btn-primary mt-auto"
                          href="{{route('admin.companies.index').'?create'}}">{{trans('labels.backend.agendas.add_companies')}}</a>
                </div>
            </div>

            <div class="row">
                <div class="col-10 form-group">
                    {!! Form::label('course_id',trans('labels.backend.agendas.fields.course'), ['class' => 'control-label']) !!}
                    {!! Form::select('course_id', $courses, $course_id, ['class' => 'form-control select2 js-example-placeholder-single', 'id' => 'course_id', 'multiple' => false, 'required' => true]) !!}
                </div>
                <div class="col-2 d-flex form-group flex-column">
                    OR <a target="_blank" class="btn btn-primary mt-auto"
                          href="{{route('admin.courses.index').'?create'}}">{{trans('labels.backend.agendas.add_courses')}}</a>
                </div>
            </div>

            <div class="row">
                <div class="col-10 form-group">
                    {!! Form::label('teacher_id',trans('labels.backend.agendas.fields.teacher'), ['class' => 'control-label']) !!}
                    {!! Form::select('teacher_id', $teachers, old('teacher_id'), ['class' => 'form-control select2 js-example-placeholder-single', 'multiple' => false, 'required' => true]) !!}
                </div>
                <div class="col-2 d-flex form-group flex-column">
                    OR <a target="_blank" class="btn btn-primary mt-auto"
                          href="{{route('admin.teachers.index').'?create'}}">{{trans('labels.backend.agendas.add_teachers')}}</a>
                </div>
            </div>

            <div class="row">
                <div class="col-10 form-group">
                    {!! Form::label('location_id',trans('labels.backend.agendas.fields.location'), ['class' => 'control-label']) !!}
                    {!! Form::select('location_id', $locations, old('location_id'), ['class' => 'form-control select2 js-example-placeholder-single', 'multiple' => false, 'required' => true]) !!}
                </div>
                <div class="col-2 d-flex form-group flex-column">
                    OR <a target="_blank" class="btn btn-primary mt-auto"
                          href="{{route('admin.locations.index').'?create'}}">{{trans('labels.backend.agendas.add_locations')}}</a>
                </div>
            </div>


            <div class="row">
                <div class="col-12 col-lg-4  form-group">
                    {!! Form::label('start_date', trans('labels.backend.agendas.fields.start_date').' (yyyy-mm-dd)', ['class' => 'control-label']) !!}
                    {!! Form::text('start_date', old('start_date'), ['class' => 'form-control date','pattern' => '(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))', 'placeholder' => trans('labels.backend.agendas.fields.start_date').' (Ex . 2019-01-01)', 'autocomplete' => 'off']) !!}

                </div>
                <div class="col-12 col-lg-4  form-group">
                    {!! Form::label('end_date', trans('labels.backend.agendas.fields.end_date').' (yyyy-mm-dd)', ['class' => 'control-label']) !!}
                    {!! Form::text('end_date', old('end_date'), ['class' => 'form-control date','pattern' => '(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))', 'placeholder' => trans('labels.backend.agendas.fields.end_date').' (Ex . 2019-01-01)', 'autocomplete' => 'off']) !!}

                </div>

                <div class="col-12 col-lg-4 form-group">
                    {!! Form::label('student_quantity',  trans('labels.backend.agendas.fields.student_quantity'), ['class' => 'control-label']) !!}
                    {!! Form::number('student_quantity', old('student_quantity'), ['class' => 'form-control', 'placeholder' =>  trans('labels.backend.agendas.fields.student_quantity')]) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-12  text-center form-group">

                    {!! Form::submit(trans('strings.backend.general.app_save'), ['class' => 'btn btn-lg btn-danger']) !!}
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}


@stop

@push('after-scripts')
    <script type="text/javascript" src="{{asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript" src="{{asset('/vendor/unisharp/laravel-ckeditor/adapters/jquery.js')}}"></script>
    <script src="{{asset('/vendor/laravel-filemanager/js/lfm.js')}}"></script>
    <script>
        $('.editor').each(function () {

            CKEDITOR.replace($(this).attr('id'), {
                filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
                filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}',
                extraPlugins: 'smiley,lineutils,widget,codesnippet,prism,flash,colorbutton,colordialog',
            });

        });

        $(document).ready(function () {
            $(".js-example-placeholder-single").select2({
                placeholder: "{{trans('labels.backend.agendas.select_course')}}",
            });
            $(document).on('change', '#course_id', function (e) {
                var course_id = $(this).val();
                window.location.href = "{{route('admin.agendas.create')}}" + "?course_id=" + course_id;
            });
            $('#start_date').datepicker({
                autoclose: true,
                dateFormat: "{{ config('app.date_format_js') }}"
            });

            $('#end_date').datepicker({
                autoclose: true,
                dateFormat: "{{ config('app.date_format_js') }}"
            });

            var dateToday = new Date();
            $('#expire_at').datepicker({
                autoclose: true,
                minDate: dateToday,
                dateFormat: "{{ config('app.date_format_js') }}"
            });

            $(".js-example-placeholder-multiple").select2({
                placeholder: "{{trans('labels.backend.courses.select_teachers')}}",
            });
        });

        var uploadField = $('input[type="file"]');

        $(document).on('change', 'input[type="file"]', function () {
            var $this = $(this);
            $(this.files).each(function (key, value) {
                if (value.size > 5000000) {
                    alert('"' + value.name + '"' + 'exceeds limit of maximum file upload size')
                    $this.val("");
                }
            })
        })


        $(document).on('change', '#media_type', function () {
            if ($(this).val()) {
                if ($(this).val() != 'upload') {
                    $('#video').removeClass('d-none').attr('required', true)
                    $('#video_file').addClass('d-none').attr('required', false)
//                    $('#video_subtitle_box').addClass('d-none').attr('required', false)

                } else if ($(this).val() == 'upload') {
                    $('#video').addClass('d-none').attr('required', false)
                    $('#video_file').removeClass('d-none').attr('required', true)
//                    $('#video_subtitle_box').removeClass('d-none').attr('required', true)
                }
            } else {
                $('#video_file').addClass('d-none').attr('required', false)
//                $('#video_subtitle_box').addClass('d-none').attr('required', false)
                $('#video').addClass('d-none').attr('required', false)
            }
        })


    </script>

@endpush
