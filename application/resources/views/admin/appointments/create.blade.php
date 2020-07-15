@extends('layouts.app')

@section('content')
<style type="text/css">
	

</style>
    
    {!! Form::open(['method' => 'POST', 'route' => ['admin.appointments.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
           @lang('quickadmin.appointments.title') @lang('quickadmin.qa_create')
        </div>
        
        <div class="panel-body">
        	<div class="col-md-9 col-sm-9 col-lg-9">
            <div class="row ">
                <div class="col-xs-12 form-group">
					{!! Form::label('client_id', 'Executive*', ['class' => 'control-label']) !!}
                    <select id="client_id" name="client_id" class="form-control select2" required>
						<option value="">Please select</option>
						@foreach($clients as $client)
						<option value="{{ $client->id }}" {{ (old("client_id") == $client->id ? "selected":"") }}>{{ $client->first_name }} {{ $client->last_name }}</option>
						@endforeach
					</select>
                    <p class="help-block"></p>
                    @if($errors->has('client_id'))
                        <p class="help-block">
                            {{ $errors->first('client_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('service_id', 'Purpose*', ['class' => 'control-label']) !!}
                    <select id="service_id" name="service_id" class="form-control select2" required>
						<option value="">Please select</option>
						@foreach($services as $service)
							<option value="{{ $service->id }}" data-price="{{ $service->price }}" {{ (old("service_id") == $service->id ? "selected":"") }}>{{ $service->name }}</option>
						@endforeach
					</select>
                    <p class="help-block"></p>
                    @if($errors->has('service_id'))
                        <p class="help-block">
                            {{ $errors->first('service_id') }}
                        </p>
                    @endif
					<input type="hidden" id="price" value="0">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('date', 'Date*', ['class' => 'control-label']) !!}
                    {!! Form::text('date', old('date'), ['class' => 'form-control date', 'placeholder' => '', 'required' => '','id'=>'date']) !!}
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
                    {!! Form::label('comments', 'Comments', ['class' => 'control-label']) !!}
                    {!! Form::textarea('comments', old('comments'), ['class' => 'form-control ', 'rows'=>'5','placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('comments'))
                        <p class="help-block">
                            {{ $errors->first('comments') }}
                        </p>
                    @endif
                </div>
            </div>
            {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'col-md-1 btn btn-success pull-right']) !!}
            </div>
            
        
        <div class="col-md-3 col-sm-3 col-lg-3">
            	<div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('date', 'Time Slot*', ['class' => 'control-label']) !!}
                    
                    <table border="1px" padding="5px">
                    	<tbody>
                    		<tr id="timeSlot">
                    			                    			
                    		</tr>
                    	</tbody>
                    </table>
                    <p class="help-block"></p>
                    
                </div>
            </div>
            </div>
            </div>
    </div>

    
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent
    <script src="{{ url('quickadmin/js') }}/timepicker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.4.5/jquery-ui-timepicker-addon.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>    <script>
        $('.datetime').datetimepicker({
            autoclose: true,
            dateFormat: "{{ config('app.date_format_js') }}",
            timeFormat: "HH:mm:ss"
        });
    </script>
	<script>
	$('.date').datepicker({
		autoclose: true,
		dateFormat: "{{ config('app.date_format_js') }}"
	}).datepicker("setDate", "0");
    </script>
	<script>
		$("#service_id").on("change", function() {
			$("#price").val($('option:selected', this).attr('data-price'));
			var date = $("#date").val();
			var service_id = $("#service_id").val();
			UpdateEmployees(service_id, date);
		});
		$("#client_id").on("change", function() {
			//$("#price").val($('option:selected', this).attr('data-price'));
			var date = $("#date").val();
			var service_id = $("#service_id").val();
			var client_id = $("#client_id").val();
			UpdateTimeSlot(client_id, date);
		});
		$("#date").on("change", function() {
			//$("#price").val($('option:selected', this).attr('data-price'));
			var date = $("#date").val();
			var service_id = $("#service_id").val();
			var client_id = $("#client_id").val();
			UpdateTimeSlot(client_id, date);
		});
		
	
		$("#date").change(function() {
			var service_id = $("#service_id").val();
			var date = $("#date").val();
			UpdateEmployees(service_id, date);
		});
		
		$("#starting_hour, #finish_hour, #starting_minute, #finish_minute").on("change", function () {
			//CountPrice();		
		});
		
		
		function CountPrice() {
			
		}
		
		function UpdateEmployees(service_id, date)
		{
			/*if(service_id != "" && date != "") {
				$.ajax({
					url: '{{ url("admin/get-employees") }}',
					type: 'GET',
					headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					data: {service_id:service_id, date:date},
					success:function(option){
						//alert(option);
						$(".employees").remove();
						$("#date").closest(".row").after(option);
						$("#start_time, #finish_time").hide();
						$("#results").hide();
					}
				});
			}*/
		}
		function UpdateTimeSlot(id,date)
		{
			if(id != "" && date != "") {
				$.ajax({
					url: '{{ url("admin/TimeSlot") }}',
					type: 'GET',
					headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					data: {id:id, date:date},
					success:function(option){
						//alert(option);
						$("#timeSlot").html(option);
						/*$("#date").closest(".row").after(option);
						$("#start_time, #finish_time").hide();
						$("#results").hide();*/
					}
				});
			}
		}
		$('.times').click(
		    function() {
		        $('input[type=radio]',this).attr('checked','checked');
		    }
		);
	</script>

@stop