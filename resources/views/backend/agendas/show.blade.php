@extends('backend.layouts.app')
@section('title', __('labels.backend.agendas.title').' | '.app_name())

@push('after-styles')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/amigo-sorter/css/theme-default.css')}}">
    <style>
        ul.sorter > span {
            display: inline-block;
            width: 100%;
            height: 100%;
            background: #f5f5f5;
            color: #333333;
            border: 1px solid #cccccc;
            border-radius: 6px;
            padding: 0px;
        }

        ul.sorter li > span .title {
            padding-left: 15px;
            width: 70%;
        }

        ul.sorter li > span .btn {
            width: 20%;
        }

        @media screen and (max-width: 768px) {

            ul.sorter li > span .btn {
                width: 30%;
            }

            ul.sorter li > span .title {
                padding-left: 15px;
                width: 70%;
                float: left;
                margin: 0 !important;
            }

        }


    </style>
@endpush

@section('content')

    <div class="card">

        <div class="card-header">
            <h3 class="page-title mb-0">@lang('labels.backend.agendas.title')</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('labels.backend.agendas.fields.company')</th>
                            <td>{{ $agenda->company->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.agendas.fields.course')</th>
                            <td>{{ $agenda->course->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.agendas.fields.teacher')</th>
                            <td>{{ $agenda->teacher->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.agendas.fields.location')</th>
                            <td>{{ $agenda->location->location_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.agendas.fields.start_date')</th>
                            <td>{{ $agenda->start_date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.agendas.fields.end_date')</th>
                            <td>{{ $agenda->end_date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('labels.backend.agendas.fields.student_quantity')</th>
                            <td>{{ $agenda->student_quantity }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->

        </div>
    </div>
@stop

@push('after-scripts')
@endpush
