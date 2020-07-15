@extends('layouts.app')

@section('content')
    <style type="text/css">.panel-heading{
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    line-height: normal;
    padding-top: 8px;
}</style>

    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />

  
    <div class="panel panel-default">
        <div class="panel-heading">
           <strong>@lang('quickadmin.appointments.title') @lang('quickadmin.qa_list') </strong>
    @can('appointment_create')    
    <a href="{{ route('admin.appointments.create') }}" class="btn btn-success pull-right"><span><i class="fa fa-plus"></i></span>@lang('quickadmin.qa_add_new')</a>

    @endcan
        </div>

        <div class="panel-body table-responsive">
            @if(!empty($appointments))
            <table class="table table-bordered table-striped {{ count($appointments) > 0 ? 'datatable' : '' }} @can('appointment_delete') dt-select @endcan">
                <thead>
                <tr>
                    @can('appointment_delete')
                        <th style="text-align:center;"><input type="checkbox" id="select-all"/></th>
                    @endcan

                    <th>@lang('quickadmin.appointments.fields.client')</th>
                    <th>@lang('quickadmin.clients.fields.last-name')</th>
                    <th>@lang('quickadmin.clients.fields.phone')</th>
                    <th>@lang('quickadmin.clients.fields.email')</th>
                    <th>@lang('quickadmin.appointments.fields.employee')</th>
                    <th>@lang('quickadmin.employees.fields.last-name')</th>
                    <th>@lang('quickadmin.appointments.fields.start-time')</th>
                    
                    <th>@lang('quickadmin.appointments.fields.comments')</th>
                    <th width="200px">Action</th>
                </tr>
                </thead>

                <tbody>
                @if (!empty($appointments) > 0)
                    @foreach ($appointments as $appointment)
                        <tr data-entry-id="{{ $appointment->id }}">
                            @can('appointment_delete')
                                <td></td>
                            @endcan

                            <td>{{ $appointment->client->first_name or '' }}</td>
                            <td>{{ isset($appointment->client) ? $appointment->client->last_name : '' }}</td>
                            <td>{{ isset($appointment->client) ? $appointment->client->phone : '' }}</td>
                            <td>{{ isset($appointment->client) ? $appointment->client->email : '' }}</td>
                            <td>{{ $appointment->employee->first_name or '' }}</td>
                            <td>{{ isset($appointment->employee) ? $appointment->employee->last_name : '' }}</td>
                            <td>{{ $appointment->start_time }}</td>
                            <td>{!! $appointment->comments !!}</td>
                            <td width="200px">
                                @can('appointment_view')
                                @if($appointment->status == 1)
                                    Approved
                                    @elseif($appointment->status == 2)
                                    Rejected
                                    @endif  

                                @if($appointment->status == 0)
                                    @can('appointment_approve')
                                    <a href="{{ route('admin.appointments.approve',[$appointment->id]) }}"
                                       class="btn btn-xs btn-primary"><span><i class="fa fa-check"></i></span></a>
                                    @endcan
                                    @elseif($appointment->status == 1)           
                                    @can('appointment_approve')
                                    <a href="{{ route('admin.appointments.reject',[$appointment->id]) }}"
                                       class="btn btn-xs btn-danger"><span><i class="fa fa-ban"></i></span></a> 
                                    @endcan
                                    @endif                    

                                    <a href="{{ route('admin.appointments.show',[$appointment->id]) }}"
                                       class="btn btn-xs btn-primary"><span><i class="fa fa-eye"></i></span></a>

                                @endcan

                                @can('appointment_edit')
                                    <a href="{{ route('admin.appointments.edit',[$appointment->id]) }}"
                                       class="btn btn-xs btn-info"><span><i class="fa fa-edit"></i></span></a>
                                @endcan
                                @can('appointment_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.appointments.destroy', $appointment->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="9">@lang('quickadmin.qa_no_entries_in_table')</td>
                    </tr>
                @endif
                </tbody>
            </table>
            @endif
        </div>
    </div>
    <br/>
      <div id='calendar'></div>
@stop

@section('javascript')
    <script>
        @can('appointment_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.appointments.mass_destroy') }}';
        @endcan

    </script>
     @if(!empty($appointments))
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
    <script>
        $(document).ready(function() {
            // page is now ready, initialize the calendar...
            $('#calendar').fullCalendar({
                // put your options and callbacks here
                defaultView: 'agendaWeek',
                events : [
                        @foreach($appointments as $appointment)
                    {
                        title : '{{ $appointment->client['first_name'] . ' ' .                       $appointment->client['last_name'] }}',
                        start : '{{ $appointment->date . ' ' .  $appointment->start_time }}',
                        end : '{{ strtotime('+60 minutes', strtotime($appointment->start_time)) }}',
                        url : '{{ route('admin.appointments.edit', $appointment->id) }}'
                    },
                    @endforeach
                ]
            })
        });
    </script>
    @endif
@endsection
