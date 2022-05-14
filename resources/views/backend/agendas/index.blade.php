@inject('request', 'Illuminate\Http\Request')
@extends('backend.layouts.app')
@section('title', __('labels.backend.agendas.title').' | '.app_name())
@push('after-styles')
    <link rel="stylesheet" href="{{asset('assets/css/colors/switch.css')}}">

    <link rel="stylesheet" href="{{asset('codebase/dhtmlxscheduler_material.css')}}">

@endpush
@section('content')
    <div class="card">
        <div class="card-header">
                <h3 class="page-title d-inline">@lang('labels.backend.agendas.title')
                @if(auth()->user()->isAdmin())
                    <div class="float-right">
                        <a href="{{ route('admin.agendas.create') }}"
                            class="btn btn-success">@lang('strings.backend.general.app_add_new')</a>

                    </div>
                @endif
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div id="scheduler_here" class="dhx_cal_container" style='width:100%; height:600px'>
                        <div class="dhx_cal_navline">
                            <div class="dhx_cal_prev_button">&nbsp;</div>
                            <div class="dhx_cal_next_button">&nbsp;</div>
                            <div class="dhx_cal_today_button"></div>
                            <div class="dhx_cal_date"></div>
                            <div class="dhx_cal_tab" name="day_tab" style="right:204px;"></div>
                            <div class="dhx_cal_tab" name="week_tab" style="right:140px;"></div>
                            <div class="dhx_cal_tab" name="month_tab" style="right:76px;"></div>
                        </div>
                        <div class="dhx_cal_header">
                        </div>
                        <div class="dhx_cal_data">
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <div class="d-block">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a href="{{ route('admin.courses.index') }}"
                               style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">{{trans('labels.general.all')}}</a>
                        </li>
                        |
                        <li class="list-inline-item">
                            <a href="{{ route('admin.courses.index') }}?show_deleted=1"
                               style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">{{trans('labels.general.trash')}}</a>
                        </li>
                    </ul>
                </div>

                <table id="myTable" class="table table-bordered table-striped @can('course_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                    <thead>
                    <tr>
                        @can('course_view')
                            @if ( request('show_deleted') != 1 )
                                <th style="text-align:center;"><input type="checkbox" class="mass" id="select-all"/></th>@endif
                        @endcan


                        @if (Auth::user()->isAdmin())
                                <th>@lang('labels.general.sr_no')</th>
                                <th>@lang('labels.general.id')
{{--                                <th>@lang('labels.backend.courses.fields.teachers')</th>--}}
                        @else
                                <th>@lang('labels.general.sr_no')</th>
                                <th>@lang('labels.general.id')

                            @endif

                        <th>@lang('labels.backend.agendas.fields.company')</th>
                        <th>@lang('labels.backend.agendas.fields.course')</th>
                        <th>@lang('labels.backend.agendas.fields.teacher')</th>
                        <th>@lang('labels.backend.agendas.fields.completed_at')</th>
                        <th>&nbsp; @lang('strings.backend.general.actions')</th>
                    </tr>
                    </thead>

                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
@endsection

@push('after-scripts')
    <script src="{{asset('codebase/dhtmlxscheduler.js')}}" type="text/javascript"></script>
    <script>
		window.addEventListener("DOMContentLoaded", function(){
		    scheduler.config.drag_create = false;
		    scheduler.config.dblclick_create = false;
		    scheduler.config.readonly_form = true;
			scheduler.init('scheduler_here',new Date(),"month");
			scheduler.load("{{ route('admin.agendas.get_agendas') }}", "json");
		});
		scheduler.attachEvent("onEventChanged", function(id,ev){
            console.log(id, ev);
        });
		scheduler.attachEvent("onEventSave",function(id,ev,is_new){
            console.log(id, ev, is_new);
        });
		scheduler.attachEvent("onEventDeleted", function(id,ev){
            console.log(id, ev);
        });
		scheduler.attachEvent("onEventAdded", function(id,ev){
            console.log('created! ', id, ev);
        });

		$(document).ready(function () {
            var route = '{{route('admin.agendas.get_data')}}';

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
                            columns: [ 1, 2, 3, 4,5,6 ]
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: [ 1, 2, 3, 4,5,6 ]
                        }
                    },
                    'colvis'
                ],
                ajax: route,
                columns: [
                        @if(request('show_deleted') != 1)
                    { "data": function(data){
                        return '<input type="checkbox" class="single" name="id[]" value="'+ data.id +'" />';
                    }, "orderable": false, "searchable":false, "name":"id" },
                        @endif
                        @if (Auth::user()->isAdmin())
                    {data: "DT_RowIndex", name: 'DT_RowIndex', searchable: false, orderable:false},
                    {data: "id", name: 'id'},

                    @else
                    {data: "DT_RowIndex", name: 'DT_RowIndex', searchable: false},
                    {data: "id", name: 'id'},

                    @endif
                    {data: "company", name: 'company'},
                    {data: "course", name: 'course'},
                    {data: 'teacher', name: 'teacher'},
                    {data: 'completed_at', name: 'completed_at'},
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
                language:{
                    url : "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/{{$locale_full_name}}.json",
                    buttons :{
                        colvis : '{{trans("datatable.colvis")}}',
                        pdf : '{{trans("datatable.pdf")}}',
                        csv : '{{trans("datatable.csv")}}',
                    }
                }
            });
        });
	</script>
@endpush