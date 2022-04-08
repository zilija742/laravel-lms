@extends('backend.layouts.app')
@section('title', __('labels.backend.courses.title').' | '.app_name())

@section('content')

    {!! Form::model($student_comment, ['method' => 'PUT', 'route' => ['admin.student_comments.update', $course_id, $user_id], 'files' => true,]) !!}

    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0">@lang('labels.backend.courses.evaluate_student')</h3>
            <div class="float-right">
                <a href="{{ route('admin.student_comments.index', [$course_id]) }}"
                   class="btn btn-success">@lang('labels.backend.courses.view_students')</a>
            </div>
        </div>

        <div class="card-body">


            <div class="row">
                <div class="col-12 form-group">
                    {!! Form::label('comment',trans('labels.backend.courses.fields.comment'), ['class' => 'control-label']) !!}
                    {!! Form::textarea('comment', old('comment'), ['class' => 'form-control editor', 'placeholder' => trans('labels.backend.courses.fields.comment'), 'disabled' => auth()->user()->hasRole('company admin') ? true : false]) !!}
                </div>
            </div>

            <div class="form-group row">
                {{ html()->label(__('labels.backend.courses.fields.approved'))->class('col-md-2 form-control-label')->for('is_approved') }}
                <div class="col-md-10">
                    {{ html()->label(html()->checkbox('')->name('is_approved')
                                       ->checked(old('is_approved'))->class('switch-input')->value(old('is_approved'))

                                   . '<span class="switch-label"></span><span class="switch-handle"></span>')
                               ->class('switch switch-lg switch-3d switch-primary')
                    }}
                </div>
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
                placeholder: "{{trans('labels.backend.courses.select_category')}}",
            });

            $(".js-example-placeholder-multiple").select2({
                placeholder: "{{trans('labels.backend.courses.select_teachers')}}",
            });
        });
        $(document).on('change', 'input[type="file"]', function () {
            var $this = $(this);
            $(this.files).each(function (key, value) {
                if (value.size > 50000000) {
                    alert('"' + value.name + '"' + 'exceeds limit of maximum file upload size')
                    $this.val("");
                }
            })
        });

        $(document).ready(function () {
            $(document).on('click', '.delete', function (e) {
                e.preventDefault();
                var parent = $(this).parent('.form-group');
                var confirmation = confirm('{{trans('strings.backend.general.are_you_sure')}}')
                if (confirmation) {
                    var media_id = $(this).data('media-id');
                    $.post('{{route('admin.media.destroy')}}', {media_id: media_id, _token: '{{csrf_token()}}'},
                        function (data, status) {
                            if (data.success) {
                                parent.remove();
                                $('#video').val('').addClass('d-none').attr('required', false);
                                $('#video_file').attr('required', false);
                                $('#media_type').val('');


                            } else {
                                alert('Something Went Wrong')
                            }
                        });
                }
            })
        });


    </script>

@endpush
