<?php

namespace App\Http\Controllers\Admin;
use Auth;
use App\WorkingHour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreWorkingHoursRequest;
use App\Http\Requests\Admin\UpdateWorkingHoursRequest;

class WorkingHoursController extends Controller
{
    /**
     * Display a listing of WorkingHour.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('working_hour_access')) {
            return abort(401);
        }
        //dd(Auth::user()->role_id);
        if(Auth::user()->role_id ===1){
            $working_hours = WorkingHour::all();
        }
        else if(Auth::user()->role_id ===2)
        {
            $executive_id = \App\Client::where('email','=',Auth::user()->email)->first();
            $working_hours = WorkingHour::where('executive_id','=',$executive_id->id)->get();   
        }
        else if(Auth::user()->role_id ===3)
        {
            $boss_id = \App\Employee::where('email','=',Auth::user()->email)->first();
            $working_hours = WorkingHour::where('executive_id','=',$boss_id->executive_id)->get();   
        }
        return view('admin.working_hours.index', compact('working_hours'));
    }

    /**
     * Show the form for creating new WorkingHour.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('working_hour_create')) {
            return abort(401);
        }
        if(Auth::user()->role_id ===1){
            $relations = [
                'executes' => \App\Client::get(),
            ];
        }
        else
        {
            $executive_id = \App\Employee::where('email','=',Auth::user()->email)->first();
            //dd($executive_id);
            $relations = [
                'executes' => \App\Client::where('id','=',$executive_id->id)->get(),
            ];   
        }
        
        //dd($relations);
        return view('admin.working_hours.create', $relations);
    }

    /**
     * Store a newly created WorkingHour in storage.
     *
     * @param  \App\Http\Requests\StoreWorkingHoursRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWorkingHoursRequest $request)
    {
        if (! Gate::allows('working_hour_create')) {
            return abort(401);
        }
        
        //dd($request->executive_id);
        $workingHour = new WorkingHour;
        $workingHour->start_time = date("H:i:s", strtotime($request->start_time));
        $workingHour->finish_time = date("H:i:s", strtotime($request->finish_time));
        $workingHour->executive_id = $request->executive_id;
        $workingHour->date = date("Y-m-d", strtotime($request->date));
        $workingHour->comments = $request->comments;
        $workingHour->save();
        /*$request->start_time = date("H:i:s", strtotime($request->start_time));
        $request->finish_time = date("H:i:s", strtotime($request->finish_time));
        $working_hour = WorkingHour::create($request->all());*/



        return redirect()->route('admin.working_hours.index');
    }


    /**
     * Show the form for editing WorkingHour.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('working_hour_edit')) {
            return abort(401);
        }
        $relations = [
            'executes' => \App\Client::get()->pluck('first_name', 'id')->prepend('Please select', ''),
        ];

        $working_hour = WorkingHour::findOrFail($id);
        
        
        return view('admin.working_hours.edit', compact('working_hour') + $relations);
    }

    /**
     * Update WorkingHour in storage.
     *
     * @param  \App\Http\Requests\UpdateWorkingHoursRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWorkingHoursRequest $request, $id)
    {
        if (! Gate::allows('working_hour_edit')) {
            return abort(401);
        }
        $working_hour = WorkingHour::findOrFail($id);    
         $working_hour->start_time = date("H:i:s", strtotime($request->start_time));
        $working_hour->finish_time = date("H:i:s", strtotime($request->finish_time));
        $working_hour->executive_id = $request->executive_id;
        $working_hour->date = date("Y-m-d", strtotime($request->date));
        $working_hour->comments = $request->comments;    
        $working_hour->update();
        return redirect()->route('admin.working_hours.index');
    }


    /**
     * Display WorkingHour.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('working_hour_view')) {
            return abort(401);
        }
        $relations = [
            'employees' => \App\Employee::get()->pluck('first_name', 'id')->prepend('Please select', ''),
        ];

        $working_hour = WorkingHour::findOrFail($id);

        return view('admin.working_hours.show', compact('working_hour') + $relations);
    }


    /**
     * Remove WorkingHour from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('working_hour_delete')) {
            return abort(401);
        }
        $working_hour = WorkingHour::findOrFail($id);
        $working_hour->delete();

        return redirect()->route('admin.working_hours.index');
    }

    /**
     * Delete all selected WorkingHour at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('working_hour_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = WorkingHour::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
