@extends('backend.layouts.app')

@section('title', __('labels.backend.companies.title').' | '.app_name())
@push('after-styles')
<style>
    table th {
        width: 20%;
    }
</style>
@endpush
@section('content')

    <div class="card">

        <div class="card-header">
            <h3 class="page-title d-inline mb-0">@lang('labels.backend.companies.title')</h3>
            <div class="float-right">
                <a href="{{ route('admin.companies.index') }}"
                   class="btn btn-success">@lang('labels.backend.companies.view')</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('labels.backend.companies.fields.name')</th>
                            <td>{{ $company->name }}</td>
                        </tr>

                        <tr>
                            <th>@lang('labels.backend.companies.fields.kvk_number')</th>
                            <td>{{ $company->kvk_number }}</td>
                        </tr>

                        <tr>
                            <th>@lang('labels.backend.companies.fields.btw_number')</th>
                            <td>{{ $company->btw_number }}</td>
                        </tr>

                         <tr>
                            <th>@lang('labels.backend.companies.fields.company_image')</th>
                            <td>@if($company->picture)<a
                                        href="{{ asset('storage/uploads/' . $company->picture) }}"
                                        target="_blank"><img
                                            src="{{ asset('storage/uploads/' . $company->picture) }}"
                                            height="50px"/></a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.companies.fields.contact_email')</th>
                            <td>{{ $company->contact_email }}</td>
                        </tr>
                        
                        <tr>
                            <th>@lang('labels.backend.companies.fields.contact_number')</th>
                            <td>{{ $company->contact_number }}</td>
                        </tr>
                        
                        <tr>
                            <th>@lang('labels.backend.companies.fields.location')</th>
                            <td>{{ $company->location }}</td>
                        </tr>
                        
                        <tr>
                            <th>@lang('labels.backend.companies.fields.description')</th>
                            <td>{{ $company->description }}</td>
                        </tr>

                        <tr>
                            <th>@lang('labels.backend.companies.fields.count_employee')</th>
                            <td>{{ $company->countEmployee() }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
        </div>
    </div>
@stop
