@extends('backend.layouts.app')
@section('title', __('labels.backend.students.title').' | '.app_name())
@push('after-styles')
    <link rel="stylesheet" href="{{asset('assets/css/colors/switch.css')}}">
@endpush
@section('content')

    <div class="card">
        <div class="card-header">
                <h3 class="page-title d-inline">@lang('labels.backend.students.title')</h3>
            @if (auth()->user()->hasRole('company admin'))
                <div class="float-right">
                    <a href="{{ route('admin.students.create') }}"
                       class="btn btn-success">@lang('strings.backend.general.app_add_new')</a>

                </div>
            @endif
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <div class="d-block">
                            @if (auth()->user()->hasRole('company admin'))
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="{{ route('admin.students.index') }}"
                                       style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">{{trans('labels.general.all')}}</a>
                                </li>
                                |
                                <li class="list-inline-item">
                                    <a href="{{ route('admin.students.index') }}?show_deleted=1"
                                       style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">{{trans('labels.general.trash')}}</a>
                                </li>
                            </ul>
                            @endif
                        </div>


                        <table id="myTable"
                               class="table table-bordered table-striped @if(auth()->user()->isAdmin() || auth()->user()->hasRole('company admin')) @if ( request('show_deleted') != 1 ) dt-select @endif @endif">
                            <thead>
                            <tr>

                                @if (auth()->user()->hasRole('company admin') || auth()->user()->isAdmin())
                                    @if ( request('show_deleted') != 1 )
                                        <th style="text-align:center;"><input type="checkbox" class="mass" id="select-all"/>
                                        </th>
                                    @endif
                                @endif

                                <th>#</th>
                                <th>ID</th>
                                <th>@lang('labels.backend.students.fields.first_name')</th>
                                <th>@lang('labels.backend.students.fields.last_name')</th>
                                <th>@lang('labels.backend.students.fields.email')</th>
                                @if(auth()->user()->hasRole('company admin'))
                                <th>@lang('labels.backend.students.fields.status')</th>
                                @if( request('show_deleted') == 1 )
                                    <th>&nbsp; @lang('strings.backend.general.actions')</th>
                                @else
                                    <th>&nbsp; @lang('strings.backend.general.actions')</th>
                                @endif
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

@endsection

@push('after-scripts')
    <script>

        $(document).ready(function () {



            var route = '{{route('admin.students.get_data')}}';

            @if(request('show_deleted') == 1)
                route = '{{route('admin.students.get_data',['show_deleted' => 1])}}';
            @endif

            @if(request('company_id') != "")
                route = '{{route('admin.students.get_data',['company_id' => request('company_id')])}}';
            @endif
            var table = $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                iDisplayLength: 10,
                retrieve: true,
                dom: 'lfBrtip<"actions">',
                buttons: [
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [ 1, 2, 3, 4,5]
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: [ 1, 2, 3, 4,5],
                        }
                    },
                    'colvis'
                ],
                ajax: route,
                columns: [
                        @if(request('show_deleted') != 1)
                    {
                        "data": function (data) {
                            return '<input type="checkbox" class="single" name="id[]" value="' + data.id + '" />';
                        }, "orderable": false, "searchable": false, "name": "id"
                    },
                        @endif
                    {data: "DT_RowIndex", name: 'DT_RowIndex', searchable: false, orderable:false},
                    {data: "id", name: 'id'},
                    {data: "first_name", name: 'first_name'},
                    {data: "last_name", name: 'last_name'},
                    {data: "email", name: 'email'},
                    @if (auth()->user()->hasRole('company admin'))
                    {data: "status", name: 'status'},
                    {data: "actions", name: 'actions'}
                    @endif
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
                language:{
                    url : "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/{{$locale_full_name}}.json",
                    buttons :{
                        colvis : '{{trans("datatable.colvis")}}',
                        pdf : '{{trans("datatable.pdf")}}',
                        csv : '{{trans("datatable.csv")}}',
                    }
                }

            });
            @if(auth()->user()->isAdmin() || auth()->user()->hasRole('company admin'))
            $('.actions').html('<a href="' + '{{ route('admin.teachers.mass_destroy') }}' + '" class="btn btn-xs btn-danger js-delete-selected" style="margin-top:0.755em;margin-left: 20px;">Delete selected</a>');
            @endif



        });
        $(document).on('click', '.switch-input', function (e) {
            var id = $(this).data('id');
            $.ajax({
                type: "POST",
                url: "{{ route('admin.teachers.status') }}",
                data: {
                    _token:'{{ csrf_token() }}',
                    id: id,
                },
            }).done(function() {
                var table = $('#myTable').DataTable();
                table.ajax.reload();
            });
        })

    </script>

@endpush