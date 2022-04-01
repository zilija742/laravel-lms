@extends('backend.layouts.app')

@section('title', __('labels.backend.companies.title').' | '.app_name())

@section('content')
    {{ html()->form('POST', route('admin.companies.store'))->acceptsFiles()->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-header">
            <h3 class="page-title d-inline">@lang('labels.backend.companies.create')</h3>
            <div class="float-right">
                <a href="{{ route('admin.companies.index') }}"
                   class="btn btn-success">@lang('labels.backend.companies.view')</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.companies.fields.name'))->class('col-md-2 form-control-label')->for('name') }}

                        <div class="col-md-10">
                            {{ html()->text('name')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.companies.fields.name'))
                                ->attribute('maxlength', 191)
                                ->required()
                                ->autofocus() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.companies.fields.number'))->class('col-md-2 form-control-label')->for('number') }}

                        <div class="col-md-10">
                            {{ html()->text('number')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.companies.fields.number'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.courses.fields.course_image'))->class('col-md-2 form-control-label')->for('picture') }}

                        <div class="col-md-10">
                            {{ html()->file('picture')
                                ->class('form-control')
                             }}
                            {!! Form::hidden('course_image_max_size', 8) !!}
                            {!! Form::hidden('course_image_max_width', 4000) !!}
                            {!! Form::hidden('course_image_max_height', 4000) !!}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.companies.fields.contact_email'))->class('col-md-2 form-control-label')->for('contact_email') }}

                        <div class="col-md-10">
                            {{ html()->email('contact_email')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.companies.fields.contact_email'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.companies.fields.contact_number'))->class('col-md-2 form-control-label')->for('contact_number') }}

                        <div class="col-md-10">
                            {{ html()->text('contact_number')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.companies.fields.contact_number'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.companies.fields.location'))->class('col-md-2 form-control-label')->for('location') }}

                        <div class="col-md-10">
                            {{ html()->text('location')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.companies.fields.location'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->


                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.companies.fields.description'))->class('col-md-2 form-control-label')->for('description') }}

                        <div class="col-md-10">
                            {{ html()->textarea('description')
                                            ->class('form-control')
                                            ->placeholder(__('labels.backend.companies.fields.description')) }}
                        </div><!--col-->
                    </div>

                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.companies.fields.admin_first_name'))->class('col-md-2 form-control-label')->for('first_name') }}

                        <div class="col-md-10">
                            {{ html()->text('first_name')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.companies.fields.admin_first_name'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.companies.fields.admin_last_name'))->class('col-md-2 form-control-label')->for('last_name') }}

                        <div class="col-md-10">
                            {{ html()->text('last_name')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.companies.fields.admin_last_name'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.companies.fields.admin_email'))->class('col-md-2 form-control-label')->for('email') }}

                        <div class="col-md-10">
                            {{ html()->email('email')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.companies.fields.admin_email'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.companies.fields.admin_password'))->class('col-md-2 form-control-label')->for('password') }}

                        <div class="col-md-10">
                            {{ html()->password('password')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.companies.fields.admin_password'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.companies.fields.status'))->class('col-md-2 form-control-label')->for('active') }}
                        <div class="col-md-10">
                            {{ html()->label(html()->checkbox('')->name('active')
                                        ->checked(true)->class('switch-input')->value(1)

                                    . '<span class="switch-label"></span><span class="switch-handle"></span>')
                                ->class('switch switch-lg switch-3d switch-primary')
                            }}
                        </div>

                    </div>

                    <div class="form-group row justify-content-center">
                        <div class="col-4">
                            {{ form_cancel(route('admin.companies.index'), __('buttons.general.cancel')) }}
                            {{ form_submit(__('buttons.general.crud.create')) }}
                        </div>
                    </div><!--col-->
                </div>
            </div>
        </div>
    </div>
    {{ html()->form()->close() }}
@endsection