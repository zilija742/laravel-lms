@extends('backend.layouts.app')

@section('title', __('labels.backend.students.title').' | '.app_name())

@section('content')
    {{ html()->form('POST', route('admin.students.store'))->acceptsFiles()->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-header">
            <h3 class="page-title d-inline">@lang('labels.backend.students.create')</h3>
            <div class="float-right">
                <a href="{{ route('admin.students.index') }}"
                   class="btn btn-success">@lang('labels.backend.students.view')</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.students.fields.first_name'))->class('col-md-2 form-control-label')->for('first_name') }}

                        <div class="col-md-10">
                            {{ html()->text('first_name')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.students.fields.first_name'))
                                ->attribute('maxlength', 191)
                                ->required()
                                ->autofocus() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.students.fields.last_name'))->class('col-md-2 form-control-label')->for('last_name') }}

                        <div class="col-md-10">
                            {{ html()->text('last_name')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.students.fields.last_name'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.students.fields.baptism_name'))->class('col-md-2 form-control-label')->for('baptism_name') }}

                        <div class="col-md-10">
                            {{ html()->text('baptism_name')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.students.fields.baptism_name'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.students.fields.birthday'))->class('col-md-2 form-control-label')->for('birthday') }}

                        <div class="col-md-10">
                            {{ html()->date('birthday')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.students.fields.birthday'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.students.fields.birth_place'))->class('col-md-2 form-control-label')->for('birth_place') }}

                        <div class="col-md-10">
                            {{ html()->text('birth_place')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.students.fields.birth_place'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.students.fields.email'))->class('col-md-2 form-control-label')->for('email') }}

                        <div class="col-md-10">
                            {{ html()->email('email')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.students.fields.email'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.students.fields.password'))->class('col-md-2 form-control-label')->for('password') }}

                        <div class="col-md-10">
                            {{ html()->password('password')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.students.fields.password'))
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.students.fields.image'))->class('col-md-2 form-control-label')->for('image') }}

                        <div class="col-md-10">
                            {!! Form::file('image', ['class' => 'form-control d-inline-block', 'placeholder' => '']) !!}
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.general_settings.user_registration_settings.fields.gender'))->class('col-md-2 form-control-label')->for('gender') }}
                        <div class="col-md-10">
                            <label class="radio-inline mr-3 mb-0">
                                <input type="radio" name="gender" value="male"> {{__('validation.attributes.frontend.male')}}
                            </label>
                            <label class="radio-inline mr-3 mb-0">
                                <input type="radio" name="gender" value="female"> {{__('validation.attributes.frontend.female')}}
                            </label>
                            <label class="radio-inline mr-3 mb-0">
                                <input type="radio" name="gender" value="other"> {{__('validation.attributes.frontend.other')}}
                            </label>
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.students.fields.candidate_number'))->class('col-md-2 form-control-label')->for('candidate_number') }}

                        <div class="col-md-10">
                            {{ html()->text('candidate_number')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.students.fields.candidate_number'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.students.fields.driver_license_number'))->class('col-md-2 form-control-label')->for('driver_license_number') }}

                        <div class="col-md-10">
                            {{ html()->text('driver_license_number')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.students.fields.driver_license_number'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.students.fields.driver_license_category'))->class('col-md-2 form-control-label')->for('driver_license_category') }}

                        <div class="col-md-10">
                            {{ html()->text('driver_license_category')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.students.fields.driver_license_category'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.students.fields.driver_card_expire'))->class('col-md-2 form-control-label')->for('driver_card_expire') }}

                        <div class="col-md-10">
                            {{ html()->date('driver_card_expire')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.students.fields.driver_card_expire'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.students.fields.code95_expire'))->class('col-md-2 form-control-label')->for('code95_expire') }}

                        <div class="col-md-10">
                            {{ html()->date('code95_expire')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.students.fields.code95_expire'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.students.fields.vca_number'))->class('col-md-2 form-control-label')->for('vca_number') }}

                        <div class="col-md-10">
                            {{ html()->text('vca_number')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.students.fields.vca_number'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.students.fields.personal_number'))->class('col-md-2 form-control-label')->for('personal_number') }}

                        <div class="col-md-10">
                            {{ html()->text('personal_number')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.students.fields.personal_number'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.students.fields.status'))->class('col-md-2 form-control-label')->for('active') }}
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
                            {{ form_cancel(route('admin.students.index'), __('buttons.general.cancel')) }}
                            {{ form_submit(__('buttons.general.crud.create')) }}
                        </div>
                    </div><!--col-->
                </div>
            </div>
        </div>
    </div>
    {{ html()->form()->close() }}
@endsection
@push('after-scripts')

@endpush
