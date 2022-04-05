@extends('backend.layouts.app')

@section('title', __('labels.backend.locations.title').' | '.app_name())

@section('content')

    <div class="card">
        <div class="card-header">

            <h3 class="page-title d-inline">@lang('labels.backend.locations.title')</h3>
            <div class="float-right">
                <a href="{{ route('admin.locations.create') }}"
                   class="btn btn-success">@lang('strings.backend.general.app_add_new')</a>
            </div>

        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
{{--                        <div class="d-block">--}}
{{--                            <ul class="list-inline">--}}
{{--                                <li class="list-inline-item">--}}
{{--                                    <a href="{{ route('admin.locations.index') }}"--}}
{{--                                       style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">{{trans('labels.general.all')}}</a>--}}
{{--                                </li>--}}
{{--                                |--}}
{{--                                <li class="list-inline-item">--}}
{{--                                    <a href="{{ route('admin.locations.index') }}?show_deleted=1"--}}
{{--                                       style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">{{trans('labels.general.trash')}}</a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}


                        <table id="myTable"
                               class="table table-bordered table-striped @if(auth()->user()->isAdmin()) @if ( request('show_deleted') != 1 ) dt-select @endif @endif">
                            <thead>
                            <tr>

                                @can('category_delete')
                                    @if ( request('show_deleted') != 1 )
                                        <th style="text-align:center;">
                                            <input type="checkbox" class="mass" id="select-all"/>
                                        </th>
                                    @endif
                                @endcan

                                <th>@lang('labels.general.sr_no')</th>
                                <th>@lang('labels.general.id')</th>
                                <th>@lang('labels.backend.locations.fields.location_name')</th>
                                <th>@lang('labels.backend.locations.fields.address')</th>
                                <th>@lang('labels.backend.locations.fields.city')</th>
                                <th>@lang('labels.backend.locations.fields.postcode')</th>
                                <th>@lang('labels.backend.locations.fields.house_number')</th>
                                <th>@lang('labels.backend.locations.fields.country')</th>
                                @if( request('show_deleted') == 1 )
                                    <th>&nbsp; @lang('strings.backend.general.actions')</th>
                                @else
                                    <th>&nbsp; @lang('strings.backend.general.actions')</th>
                                @endif
                            </tr>
                            </thead>

                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@push('after-scripts')
    <script>
        $(document).ready(function () {
            var route = '{{route('admin.locations.get_data')}}';

            @if(request('show_deleted') == 1)
                route = '{{route('admin.locations.get_data',['show_deleted' => 1])}}';
            @endif

            $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                iDisplayLength: 10,
                retrieve: true,
                dom: 'lfBrtip<"actions">',
                buttons: [
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [1, 2, 3, 4,6,7]

                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: [1, 2, 3, 4,6,7]
                        }
                    },
                    'colvis'
                ],
                ajax: route,
                columns: [
                        @can('category_delete')
                        @if(request('show_deleted') != 1)
                    {
                        "data": function (data) {
                            return '<input type="checkbox" class="single" name="id[]" value="' + data.id + '" />';
                        }, "orderable": false, "searchable": false, "name": "id"
                    },
                        @endif
                        @endcan
                    {data: "DT_RowIndex", name: 'DT_RowIndex',searchable: false, orderable: false},
                    {data: "id", name: 'id'},
                    {data: "location_name", name: 'location_name'},
                    {data: "address", name: 'address'},
                    {data: "city", name: 'city'},
                    {data: "postcode", name: "postcode"},
                    {data: "house_number", name: "house_number"},
                    {data: "country", name: "country"},
                    {data: "actions", name: "actions"}
                ],
                @if(request('show_deleted') != 1)
                columnDefs: [
                    {"width": "5%", "targets": 0},
                    {"className": "text-center", "targets": [0]}
                ],
                @endif

                createdRow: function (row, data, dataIndex) {
                    $(row).attr('data-entry-id', data.id);
                },
                language: {
                    url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/{{$locale_full_name}}.json",
                    buttons: {
                        colvis: '{{trans("datatable.colvis")}}',
                        pdf: '{{trans("datatable.pdf")}}',
                        csv: '{{trans("datatable.csv")}}',
                    }
                }
            });
            @can('category_access')
            @if(request('show_deleted') != 1)
            $('.actions').html('<a href="' + '{{ route('admin.locations.mass_destroy') }}' + '" class="btn btn-xs btn-danger js-delete-selected" style="margin-top:0.755em;margin-left: 20px;">Delete selected</a>');
            @endif
            @endcan


            $(document).on('click', '.delete_warning', function () {
                const link = $(this);
                const cancel = (link.attr('data-trans-button-cancel')) ? link.attr('data-trans-button-cancel') : 'Cancel';

                const title = (link.attr('data-trans-title')) ? link.attr('data-trans-title') : "{{ trans('labels.backend.locations.not_allowed') }}";

                swal({
                    title: title,
                    icon: 'error',
                    showCancelButton: true,
                    cancelButtonText: cancel,
                    type: 'info'
                })
            });


        });
    </script>
@endpush
