@extends('backend.layouts.app')

@section('title', __('labels.backend.locations.title').' | '.app_name())
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
            <h3 class="page-title d-inline mb-0">@lang('labels.backend.locations.title')</h3>
            <div class="float-right">
                <a href="{{ route('admin.locations.index') }}"
                   class="btn btn-success">@lang('labels.backend.locations.view')</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('labels.backend.locations.fields.location_name')</th>
                            <td>{{ $location->location_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.locations.fields.address')</th>
                            <td>{{ $location->address }}</td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.locations.fields.postcode')</th>
                            <td>{{ $location->postcode }}</td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.locations.fields.city')</th>
                            <td>{{ $location->city }}</td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.locations.fields.house_number')</th>
                            <td>{{ $location->house_number }}</td>
                        </tr>
                        @if(isset($location->state))
                        <tr>
                            <th>@lang('labels.backend.locations.fields.state')</th>
                            <td>{{ $location->state }}</td>
                        </tr>
                        @endif
                        <tr>
                            <th>@lang('labels.backend.locations.fields.country')</th>
                            <td>{{ $location->country }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
        </div>
    </div>
@stop
