@extends('backend.layouts.app')
@section('title', __('labels.backend.students.title').' | '.app_name())

@section('content')
    {{ html()->modelForm($student, 'PATCH', route('admin.students.update', $student->id))->class('form-horizontal')->acceptsFiles()->open() }}

    <div class="card">
        <div class="card-header">
            <h3 class="page-title d-inline">@lang('labels.backend.students.edit')</h3>
            <div class="float-right">
                <a href="{{ route('admin.students.index') }}"
                   class="btn btn-success">@lang('labels.backend.students.view')</a>
            </div>
        </div>
        @php
            $studentProfile = $student->studentProfile?:'';
        @endphp

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
                                ->value($studentProfile->baptism_name)
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
                                ->value($studentProfile->birthday)
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
                                ->value($studentProfile->birth_place)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.students.fields.email'))->class('col-md-2 form-control-label')->for('email') }}

                        <div class="col-md-10">
                            {{ html()->email('email')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.students.fields.email'))
                                ->attributes(['maxlength'=> 191,'readonly'=>true])
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.students.fields.password'))->class('col-md-2 form-control-label')->for('password') }}

                        <div class="col-md-10">
                            {{ html()->password('password')
                                ->class('form-control')
                                ->value('')
                                ->placeholder(__('labels.backend.students.fields.password'))
}}
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
                                <input type="radio" name="gender" value="male" {{ $student->gender == 'male'?'checked':'' }}> {{__('validation.attributes.frontend.male')}}
                            </label>
                            <label class="radio-inline mr-3 mb-0">
                                <input type="radio" name="gender" value="female" {{ $student->gender == 'female'?'checked':'' }}> {{__('validation.attributes.frontend.female')}}
                            </label>
                            <label class="radio-inline mr-3 mb-0">
                                <input type="radio" name="gender" value="other" {{ $student->gender == 'other'?'checked':'' }}> {{__('validation.attributes.frontend.other')}}
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
                                ->value($studentProfile->candidate_number)
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
                                ->value($studentProfile->driver_license_number)
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
                                ->value($studentProfile->driver_license_category)
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
                                ->value($studentProfile->driver_card_expire)
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
                                ->value($studentProfile->code95_expire)
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
                                ->value($studentProfile->vca_number)
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
                                ->value($studentProfile->personal_number)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.students.fields.status'))->class('col-md-2 form-control-label')->for('active') }}
                        <div class="col-md-10">
                            {{ html()->label(html()->checkbox('')->name('active')
                                        ->checked(($student->active == 1) ? true : false)->class('switch-input')->value(($student->active == 1) ? 1 : 0)

                                    . '<span class="switch-label"></span><span class="switch-handle"></span>')
                                ->class('switch switch-lg switch-3d switch-primary')
                            }}
                        </div>

                    </div>


                    <div class="form-group row justify-content-center">
                        <div class="col-4">
                            {{ form_cancel(route('admin.students.index'), __('buttons.general.cancel')) }}
                            {{ form_submit(__('buttons.general.crud.update')) }}
                        </div>
                    </div><!--col-->
                </div>
            </div>
        </div>

    </div>
    {{ html()->closeModelForm() }}
@endsection
@push('after-scripts')

@endpush