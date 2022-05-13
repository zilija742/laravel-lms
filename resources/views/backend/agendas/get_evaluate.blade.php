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
    {!! Form::open(['method' => 'POST', 'route' => ['admin.agendas.evaluate'], 'files' => true,]) !!}

    <div class="card">

        <div class="card-header">
            <h3 class="page-title d-inline mb-0">@lang('labels.backend.agendas.evaluate')</h3>
{{--            <div class="float-right">--}}
{{--                <a href="{{ route('admin.students.index') }}"--}}
{{--                class="btn btn-success">@lang('labels.backend.students.view')</a>--}}
{{--            </div>--}}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered table-striped">
                        @php
                            $studentProfile = $student->studentProfile?:'';
                        @endphp
                        <tr>
                            <th>@lang('labels.backend.access.users.tabs.content.overview.avatar')</th>
                            <td><img height="100px" src="{{ $student->picture }}" class="user-profile-image" /></td>
                        </tr>

                        <tr>
                            <th>@lang('labels.backend.access.users.tabs.content.overview.name')</th>
                            <td>{{ $student->name }}</td>
                        </tr>

                        <tr>
                            <th>@lang('labels.backend.access.users.tabs.content.overview.email')</th>
                            <td>{{ $student->email }}</td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.access.users.tabs.content.overview.status')</th>
                            <td>{!! $student->status_label !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.general_settings.user_registration_settings.fields.gender')</th>
                            <td>{!! $student->gender !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.students.fields.baptism_name')</th>
                            <td>{!! $studentProfile->baptism_name !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.students.fields.birthday')</th>
                            <td>{!! $studentProfile->birthday !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.students.fields.birth_place')</th>
                            <td>{!! $studentProfile->birth_place !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.students.fields.candidate_number')</th>
                            <td>{!! $studentProfile->candidate_number !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.students.fields.driver_license_number')</th>
                            <td>{!! $studentProfile->driver_license_number !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.students.fields.driver_license_category')</th>
                            <td>{!! $studentProfile->driver_license_category !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.students.fields.driver_card_expire')</th>
                            <td>{!! $studentProfile->driver_card_expire !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.students.fields.code95_expire')</th>
                            <td>{!! $studentProfile->code95_expire !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.students.fields.vca_number')</th>
                            <td>{!! $studentProfile->vca_number !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.students.fields.personal_number')</th>
                            <td>{!! $studentProfile->personal_number !!}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
            <div class="row">

                <div class="col-12 form-group">
                    {!! Form::label('comment',trans('labels.backend.agendas.comment'), ['class' => 'control-label']) !!}
                    {!! Form::input('text', 'comment', $agenda_student->pivot->comment, ['class' => 'form-control', 'multiple' => 'multiple','required' => true]) !!}
                </div>
                <input type="hidden" value="{{ $agenda_id }}" name="agenda_id">
                <input type="hidden" value="{{ $user_id }}" name="user_id">
            </div>

            <div class="form-group row">
                {{ html()->label(__('labels.backend.agendas.approve'))->class('col-md-2 form-control-label')->for('is_approved') }}
                <div class="col-md-10">
                    {{ html()->label(html()->checkbox('')->name('is_approved')->checked($agenda_student->pivot->is_approved)->class('switch-input')->value(1) . '<span class="switch-label"></span><span class="switch-handle"></span>')->class('switch switch-lg switch-3d switch-primary') }}
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
