@extends('layouts.app')

@section('content')
    
    {!! Form::open(['method' => 'POST', 'route' => ['admin.working_hours.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
        @lang('quickadmin.working-hours.title') @lang('quickadmin.qa_create')
        </div>
        
        <div class="panel-body">
            <div class="col-md-6 col-xl-6 col-sm-6">
                <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('employee_id', 'Executives*', ['class' => 'control-label']) !!}
                    <select name="executive_id" id="employee_id" value="{{ old('employee_id') }}" class="form-control select2" required>
                        <option value="">Please select</option>
                        @foreach($executes as $execute)
                        <option value="{{ $execute->id }}">{{ $execute->first_name }} {{ $execute->last_name }}</option>
                        @endforeach
                    </select>
                    <p class="help-block"></p>
                    @if($errors->has('employee_id'))
                        <p class="help-block">
                            {{ $errors->first('employee_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('date', 'Date*', ['class' => 'control-label']) !!}
                    {!! Form::text('date', old('date'), ['class' => 'form-control', 'id'=>'datepicker','placeholder' => '', 'required' => '','autocomplete'=>'off']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('date'))
                        <p class="help-block">
                            {{ $errors->first('date') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('start_time', 'Block Time From*', ['class' => 'control-label']) !!}
                    {!! Form::text('start_time', old('start_time'), ['class' => 'form-control timepicker', 'placeholder' => '', 'required' => '','autocomplete'=>'off']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('start_time'))
                        <p class="help-block">
                            {{ $errors->first('start_time') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('finish_time', 'Block Time To', ['class' => 'control-label']) !!}
                    {!! Form::text('finish_time', old('finish_time'), ['class' => 'form-control timepicker', 'placeholder' => '','autocomplete'=>'off']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('finish_time'))
                        <p class="help-block">
                            {{ $errors->first('finish_time') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('finish_time', 'Comments*', ['class' => 'control-label']) !!}
                    {!! Form::text('comments', old('Comments'), ['class' => 'form-control ', 'placeholder' => '','autocomplete'=>'off']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('Comments'))
                        <p class="help-block">
                            {{ $errors->first('Comments') }}
                        </p>
                    @endif
                </div>
            </div>

            </div>
            <div class="col-md-6 col-xl-6 col-sm-6">
            
            
            
            </div>
            
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop
@section('javascript')
@include('layouts.time_picker')

@stop