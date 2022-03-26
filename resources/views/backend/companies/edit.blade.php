@extends('backend.layouts.app')
@section('title', __('labels.backend.companies.title').' | '.app_name())

@section('content')
    {{ html()->modelForm($company, 'PATCH', route('admin.companies.update', $company->id))->class('form-horizontal')->acceptsFiles()->open() }}

    <div class="card">
        <div class="card-header">
            <h3 class="page-title d-inline">@lang('labels.backend.companies.edit')</h3>
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
                        {{ html()->label(__('labels.backend.companies.fields.contact_email'))->class('col-md-2 form-control-label')->for('contact_email') }}

                        <div class="col-md-10">
                            {{ html()->email('contact_email')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.companies.fields.contact_email'))
                                ->attributes(['maxlength'=> 191,'readonly'=>true])
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
                                    ->value($company->description)
                                    ->placeholder(__('labels.backend.companies.fields.description')) }}
                        </div><!--col-->
                    </div>

                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.companies.fields.status'))->class('col-md-2 form-control-label')->for('active') }}
                        <div class="col-md-10">
                            {{ html()->label(html()->checkbox('')->name('active')
                                        ->checked(($company->active == 1) ? true : false)->class('switch-input')->value(($company->active == 1) ? 1 : 0)

                                    . '<span class="switch-label"></span><span class="switch-handle"></span>')
                                ->class('switch switch-lg switch-3d switch-primary')
                            }}
                        </div>

                    </div>


                    <div class="form-group row justify-content-center">
                        <div class="col-4">
                            {{ form_cancel(route('admin.companies.index'), __('buttons.general.cancel')) }}
                            {{ form_submit(__('buttons.general.crud.update')) }}
                        </div>
                    </div><!--col-->
                </div>
            </div>
        </div>

    </div>
    {{ html()->closeModelForm() }}
@endsection