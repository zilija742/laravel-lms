@inject('request', 'Illuminate\Http\Request')
@extends('backend.layouts.app')
@section('title', __('labels.backend.agendas.title').' | '.app_name())
@push('after-styles')
<style>
    span.field {
        font-size: 20px;
        font-weight: bold;
    }
    span.value {
        font-size: 20px;
    }
    div.agenda-info, div.agenda-students {
        padding: 20px;
    }
    div.agenda-info div {
        padding: 5px;
    }
    span.student-name {
        font-size: 16px;
        color: grey;
        font-weight: bold;
    }
    span.student-approved {
        background-color: green;
        color: white;
        font-size: 12px;
        padding: 5px;
        border-radius: 5px;
        font-weight: bold;
    }
    span.student-failed {
        background-color: red;
        color: white;
        font-size: 12px;
        padding: 5px;
        border-radius: 5px;
        font-weight: bold;
    }
    div.comment {
        padding: 20px;
        font-size: 16px;
    }
</style>
@endpush

@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="page-title d-inline">@lang('labels.backend.agendas.training_result')</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-lg-6 form-group">
                    {!! Form::label('agenda_id', trans('labels.backend.agendas.title'), ['class' => 'control-label']) !!}
                    {!! Form::select('agenda_id', $agendas,  (request('agenda_id')) ? request('agenda_id') : old('agenda_id'), ['class' => 'form-control js-example-placeholder-single select2 ', 'id' => 'agenda_id']) !!}
                </div>
            </div>

            @if(request('agenda_id') != "")
                <div class="row">
                    <div class="col-12 agenda-info">
                        <div><span class="field">@lang('labels.backend.agendas.fields.company')</span> : <span class="value">{{ $agenda->company->name }}</span></div>
                        <div><span class="field">@lang('labels.backend.agendas.fields.course')</span> : <span class="value">{{ $agenda->course->title }}</span></div>
                        <div><span class="field">@lang('labels.backend.agendas.fields.teacher')</span> : <span class="value">{{ $agenda->teacher->name }}</span></div>
                        <div><span class="field">@lang('labels.backend.agendas.fields.location')</span> : <span class="value">{{ $agenda->location->location_name }}</span></div>
                        <div><span class="field">@lang('labels.backend.agendas.fields.completed_at')</span> : <span class="value">{{ $agenda->completed_at }}</span></div>
                    </div>
                    <div class="col-12 agenda-students">
                        <div><span class="field">@lang('labels.backend.students.title')</span></div>
                        @foreach($agenda->students as $student)
                            <div>
                                <span class="student-name">{{ $student->name }}</span>
                                <span class="{{ $agenda->students->find($student->id)->pivot->is_approved ? 'student-approved' : 'student-failed' }}">{{ $agenda->students->find($student->id)->pivot->is_approved ? 'Approved' : 'Failed' }}</span>
                            </div>
                            <div class="comment">
                                {{ $agenda->students->find($student->id)->pivot->comment }}
                            </div>
                            <hr>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>

@stop

@push('after-scripts')
    <script>

        $(document).ready(function () {
            $(".js-example-placeholder-single").select2({
                placeholder: "{{trans('labels.backend.agendas.select_agenda')}}",
            });
            $(document).on('change', '#agenda_id', function (e) {
                var agenda_id = $(this).val();
                window.location.href = "{{route('admin.agendas.training_result')}}" + "?agenda_id=" + agenda_id
            });
        });

    </script>
@endpush