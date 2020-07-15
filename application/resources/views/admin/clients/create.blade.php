@extends('layouts.app')



@section('content')

    {!! Form::open(['method' => 'POST', 'route' => ['admin.clients.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
           @lang('quickadmin.clients.title')  @lang('quickadmin.qa_create')
        </div>
        
        <div class="panel-body">
            <div class="col-md-6 col-sm-6 col-xl-6">
                <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('first_name', 'First name', ['class' => 'control-label']) !!}
                    {!! Form::text('first_name', old('first_name'), ['class' => 'form-control', 'placeholder' => 'First name']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('first_name'))
                        <p class="help-block">
                            {{ $errors->first('first_name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('last_name', 'Last name', ['class' => 'control-label']) !!}
                    {!! Form::text('last_name', old('last_name'), ['class' => 'form-control', 'placeholder' => 'Last name']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('last_name'))
                        <p class="help-block">
                            {{ $errors->first('last_name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('phone', 'Phone', ['class' => 'control-label']) !!}
                    {!! Form::text('phone', old('phone'), ['class' => 'form-control', 'placeholder' => 'Phone']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('phone'))
                        <p class="help-block">
                            {{ $errors->first('phone') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('email'))
                        <p class="help-block">
                            {{ $errors->first('email') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('employee_id', 'How much Visitor Per hour*', ['class' => 'control-label']) !!}
                    <input name="visitor_per_hour" id="visitor_per_hour" value="{{ old('visitor_per_hour') }}" class="form-control" placeholder="Visitor per Hour" required/>
                       
                    <p class="help-block"></p>
                    @if($errors->has('visitor_per_hour'))
                        <p class="help-block">
                            {{ $errors->first('visitor_per_hour') }}
                        </p>
                    @endif
                </div>
            </div>
            
            
            </div>
            <div class="col-md-6 col-sm-6 col-xl-6">
                <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('start_time', 'Working Hour Start*', ['class' => 'control-label']) !!}
                    {!! Form::text('start_time', old('start_time'), ['class' => 'form-control timepicker', 'placeholder' => 'Working Hour Start', 'required' => '','autocomplete'=>'off']) !!}
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
                    {!! Form::label('finish_time', 'Working Hour End*', ['class' => 'control-label']) !!}
                    {!! Form::text('finish_time', old('finish_time'), ['class' => 'form-control timepicker', 'placeholder' => 'Working Hour End','autocomplete'=>'off']) !!}
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
                    {!! Form::label('start_time', 'Lunch Hour Start*', ['class' => 'control-label']) !!}
                    {!! Form::text('lunch_start_time', old('lunch_start_time'), ['class' => 'form-control timepicker', 'placeholder' => 'Lunch Hour Start', 'required' => '','autocomplete'=>'off']) !!}
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
                    {!! Form::label('finish_time', 'Lunch Hour End*', ['class' => 'control-label']) !!}
                    {!! Form::text('lunch_finish_time', old('lunch_finish_time'), ['class' => 'form-control timepicker', 'placeholder' => 'Lunch Hour End','autocomplete'=>'off']) !!}
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
                    <label for="password" class=" control-label">Password</label>

                   
                        <input id="password" type="password" placeholder="Password" class="form-control" name="password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif                   
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                <label for="password-confirm" class="control-label">Confirm Password</label>

                
                    <input id="password-confirm" placeholder="Confirm Password" type="password" class="form-control" name="password_confirmation" required>
                </div>
            </div>
            
        </div>
    </div></div>

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'pull-right btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
@include('layouts.time_picker')

@stop