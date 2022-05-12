@inject('request', 'Illuminate\Http\Request')
@extends('backend.layouts.app')
@section('title', __('labels.backend.companies.title').' | '.app_name())
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
	</script>
@endpush