@extends('backend.layouts.app')

@section('title', __('labels.backend.locations.title').' | '.app_name())

@section('content')
    {{ html()->form('POST', route('admin.locations.store'))->acceptsFiles()->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-header">
            <h3 class="page-title d-inline">@lang('labels.backend.locations.create')</h3>
            <div class="float-right">
                <a href="{{ route('admin.locations.index') }}"
                   class="btn btn-success">@lang('labels.backend.locations.view')</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.locations.fields.location_name'))->class('col-md-2 form-control-label')->for('location_name') }}

                        <div class="col-md-10">
                            {{ html()->text('location_name')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.locations.fields.location_name'))
                                ->attribute('maxlength', 191)
                                ->required()
                                ->autofocus() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.locations.fields.address'))->class('col-md-2 form-control-label')->for('address') }}

                        <div class="col-md-10">
                            {{ html()->text('address')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.locations.fields.address'))
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.locations.fields.postcode'))->class('col-md-2 form-control-label')->for('postcode') }}

                        <div class="col-md-10">
                            {{ html()->text('postcode')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.locations.fields.postcode'))
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.locations.fields.city'))->class('col-md-2 form-control-label')->for('city') }}

                        <div class="col-md-10">
                            {{ html()->text('city')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.locations.fields.city'))
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.locations.fields.house_number'))->class('col-md-2 form-control-label')->for('house_number') }}

                        <div class="col-md-10">
                            {{ html()->text('house_number')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.locations.fields.house_number'))
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.locations.fields.state'))->class('col-md-2 form-control-label')->for('state') }}

                        <div class="col-md-10">
                            {{ html()->text('state')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.locations.fields.state')) }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.locations.fields.country'))->class('col-md-2 form-control-label')->for('country') }}

                        <div class="col-md-10">
                            {{ html()->text('country')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.locations.fields.country'))
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.locations.fields.lat'))->class('col-md-2 form-control-label')->for('lat') }}

                        <div class="col-md-10">
                            {{ html()->text('lat')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.locations.fields.lat')) }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.locations.fields.long'))->class('col-md-2 form-control-label')->for('long') }}

                        <div class="col-md-10">
                            {{ html()->text('long')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.locations.fields.long')) }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.locations.fields.status'))->class('col-md-2 form-control-label')->for('active') }}
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