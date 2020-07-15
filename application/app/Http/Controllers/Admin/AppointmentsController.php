<?php

namespace App\Http\Controllers\Admin;
use Auth;
use DB;
use App\Appointment;
use App\WorkingHour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAppointmentsRequest;
use App\Http\Requests\Admin\UpdateAppointmentsRequest;

class AppointmentsController extends Controller
{
    /**
     * Display a listing of Appointment.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$appointments = array();
        //dd(Auth::user()->role->id);
        if (! Gate::allows('appointment_access')) {
            return abort(401);
        }
        //dd(Auth::user()->role_id);
        if(Auth::user()->role_id ===1){
            $appointments = Appointment::all();
        }
        else if(Auth::user()->role_id ===2)
        {
            //dd(Auth::user()->id);
            $client_id = DB::table('clients')->select('id')->where('email','=',Auth::user()->email)->first(); 
            $appointments = Appointment::where('client_id','=',$client_id->id)
                ->where('status','=', 1)->get(); 
            //dd($appointments[0]->employee);
        }
        else if(Auth::user()->role_id ===3)
        {
            //dd(Auth::user()->email);
            $executive_id = DB::table('employees')->select('executive_id')->where('email','=',Auth::user()->email)->first();            
            
            $appointments = Appointment::where('client_id','=',$executive_id->executive_id)->get();
            //$working_hours = WorkingHour::where('executive_id','=',$boss_id->executive_id)->get();   
        }
        else
        {
            $appointments = Appointment::get();
            //where('user_id','=',Auth::user()->id)->get();

            /*$working_hours = DB::table('working_hours')->get();
            foreach ($working_hours as $working_hour) {                
                $working_hour->status = 0;
                $working_hour->client = 0;                
            }
            //dd($appointments);
        $result = $appointments->merge($working_hours);
        $appointments = $result->all();
        dd($appointments);*/
        }
        //dd($appointments);

        return view('admin.appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating new Appointment.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('appointment_create')) {
            return abort(401);
        }
        $relations = [
            'clients' => \App\Client::get(),
            'employees' => \App\Employee::get(),
			'services' => \App\Service::get(),
        ];


        return view('admin.appointments.create', $relations);
    }

    public function TimeSlot(Request $request)
    {
        $id = $request->id;
        $date = $request->date;   
        //$timeselected = $request->timeselected;              
        $client = DB::table('clients')->where('id','=',$id)->first();
        $appointment_ = DB::table('appointments')
                        ->where('date','=',$date)
                        ->where('client_id','=',$client->id)
                        ->get();
        $reject_hour = DB::table('working_hours')
                        ->where('date','=',$date)
                        ->where('executive_id','=',$client->id)
                        ->get();

        $data['office_start_time'] = $client->start_time;
        $data['office_finish_time'] = $client->finish_time;
        $data['lunch_start_time'] = $client->lunch_start_time;
        $data['lunch_finish_time'] = $client->lunch_finish_time;

        $open_time = strtotime($client->start_time);
        $close_time = strtotime($client->finish_time);

        $now = time();
        $output = "";
        for( $i=$open_time; $i<$close_time; $i+=3600) {
            
            if(strtotime($client->lunch_start_time) <= $i &&  strtotime($client->lunch_finish_time) >=strtotime('+60 minutes', $i))    
            {
                $output .= "<td class='timeSlot form-control' style='background-color:red'><label>".date("H:i",$i).'-'.date("H:i",strtotime('+59 minutes', strtotime(date("H:i",$i))))."</label></td>";
            }
            elseif(strtotime($client->lunch_start_time) > $i &&  strtotime($client->lunch_start_time) <strtotime('+60 minutes', $i) )
            {
                $output .=  "<td class='timeSlot form-control' style='background-color:red'><label>".date("H:i",$i).'-'.date("H:i",strtotime('+59 minutes', strtotime(date("H:i",$i))))."</label></td>";
            }
            else{
                $block = 0;
                foreach ($reject_hour as $rejecthr) {                   
                    if(strtotime($rejecthr->start_time ) <= $i && strtotime($rejecthr->finish_time ) >= strtotime('+59 minutes', $i))
                    {
                        $output .= "<td class='timeSlot form-control' style='background-color:red'><label>".date("H:i",$i).'-'.date("H:i",strtotime('+59 minutes', strtotime(date("H:i",$i))))."</label></td>";
                        $block = 1;
                    }
                    elseif(strtotime($rejecthr->start_time ) > $i &&  strtotime($rejecthr->start_time) <strtotime('+60 minutes', $i))
                    {
                        $output .=  "<td class='timeSlot form-control' style='background-color:red'><label>".date("H:i",$i).'-'.date("H:i",strtotime('+59 minutes', strtotime(date("H:i",$i))))."</label></td>";
                        $block = 1;
                    }                               
                }
                if($block == 0){
                    $output .= "<td class='timeSlot form-control' style=''><input type='radio' class='times ' 
                    value='".date("H:i",$i)."' name='timeselected' ><label>
                    ".date("H:i",$i).'-'.date("H:i",strtotime('+59 minutes', strtotime(date("H:i",$i))))."
                    </label></td>";
                }
            }
        }
         return $output;
    }
  
    /**
     * Store a newly created Appointment in storage.
     *
     * @param  \App\Http\Requests\StoreAppointmentsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAppointmentsRequest $request)
    {
        //dd($request->all());
        if (! Gate::allows('appointment_create')) {
            return abort(401);
        }
		$client = \App\Client::find($request->client_id);

		/*$working_hours = \App\WorkingHour::where('executive_id', $request->client_id)->whereDay('date', '=', date("d", strtotime($request->date)))->whereTime('start_time', '<=', date("H:i", strtotime("".$request->starting_hour.":".$request->starting_minute.":00")))->whereTime('finish_time', '>=', date("H:i", strtotime("".$request->finish_hour.":".$request->finish_minute.":00")))->get();
        if($working_hours->isEmpty()) return redirect()->back()->withErrors("This employee isn't working at your selected time")->withInput();*/
		$appointment = new Appointment;
        /*GET USER CLIENT ID*/
        $email = DB::table('clients')->select('email')->where('id','=',$request->client_id)->first();
		$client_id = \App\User::where('email','=',$email->email)->get();
        /*END GET USER CLIENT ID*/
        $appointment->client_id = $request->client_id;
        $ps = DB::table('employees')->select('id')
                            ->where('executive_id','=',$request->client_id)->first();
        if(empty($ps))
        {
            return redirect()->back();
        }
        $appointment->user_id = Auth::user()->id;
		$appointment->employee_id = $ps->id;
        $appointment->date = $request->date;
        //dd(date("H:i:s", strtotime($request->timeselected)));
		$appointment->start_time = date("H:i:s", strtotime($request->timeselected));
        //dd($appointment->start_time);
        //$appointment->finish_time = date("H:i:s", strtotime($request->timeselected));
		$appointment->comments = $request->comments;
		$appointment->save();



        return redirect()->route('admin.appointments.index');
    }


    /**
     * Show the form for editing Appointment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('appointment_edit')) {
            return abort(401);
        }
        $appointments = Appointment::where('user_id','=',Auth::user()->id)->where('id','=',$id)->count();
        
        if($appointments == 0)
            return redirect()->back();
        $relations = [
            'clients' => \App\Client::get()->pluck('first_name', 'id')->prepend('Please select', ''),
            'employees' => \App\Employee::get()->pluck('first_name', 'id')->prepend('Please select', ''),
            'services' => \App\Service::get(),
        ];

        $appointment = Appointment::findOrFail($id);

        return view('admin.appointments.edit', compact('appointment') + $relations);
    }

    /**
     * Update Appointment in storage.
     *
     * @param  \App\Http\Requests\UpdateAppointmentsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAppointmentsRequest $request, $id)
    {
        if (! Gate::allows('appointment_edit')) {
            return abort(401);
        }
        $appointment = Appointment::findOrFail($id);
        $appointment->update($request->all());
        return redirect()->route('admin.appointments.index');
    }


    /**
     * Display Appointment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('appointment_view')) {
            return abort(401);
        }
        $relations = [
            'clients' => \App\Client::get()->pluck('first_name', 'id')->prepend('Please select', ''),
            'employees' => \App\Employee::get()->pluck('first_name', 'id')->prepend('Please select', ''),
        ];
        $appointment = Appointment::findOrFail($id);

        return view('admin.appointments.show', compact('appointment') + $relations);
    }

    public function approve($appointment_id)
    {
        if (! Gate::allows('appointment_edit')) {
            return abort(401);
        }
        $appointment = Appointment::findOrFail($appointment_id);
        $appointment->update(['status'=> 1 ]);
        return redirect()->route('admin.appointments.index');
        
    }
    public function reject($appointment_id)
    {
        if (! Gate::allows('appointment_edit')) {
            return abort(401);
        }
        $appointment = Appointment::findOrFail($appointment_id);
        $appointment->update(['status'=> 2 ]);
        return redirect()->route('admin.appointments.index');
    }
    /**
     * Remove Appointment from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('appointment_delete')) {
            return abort(401);
        }
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return redirect()->route('admin.appointments.index');
    }

    /**
     * Delete all selected Appointment at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('appointment_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Appointment::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
