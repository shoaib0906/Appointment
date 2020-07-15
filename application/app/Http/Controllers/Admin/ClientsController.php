<?php

namespace App\Http\Controllers\Admin;
use App\User;
use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreClientsRequest;
use App\Http\Requests\Admin\UpdateClientsRequest;
use Auth;
class ClientsController extends Controller
{
    /**
     * Display a listing of Client.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('client_access')) {
            return abort(401);
        }
        if(Auth::user()->role_id ===1){
            $clients = Client::all();
        }
        else
        {
            $clients = Client::where('email','=',Auth::user()->email)->get();           
        }
        //dd($appointments);
        //$clients = Client::all();

        return view('admin.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating new Client.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('client_create')) {
            return abort(401);
        }
        return view('admin.clients.create');
    }

    /**
     * Store a newly created Client in storage.
     *
     * @param  \App\Http\Requests\StoreClientsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientsRequest $request)
    {
        if (! Gate::allows('client_create')) {
            return abort(401);
        }
        $this->validate(request(), [
             'first_name' => 'required|string|max:255',
             'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users|unique:clients',
            'password' => 'required|string|min:4|confirmed',
        ]);
        $client = new Client;
        $client->start_time = date("H:i:s", strtotime($request->start_time));
        $client->finish_time = date("H:i:s", strtotime($request->finish_time));
        $client->lunch_start_time = date("H:i:s", strtotime($request->lunch_start_time));
        $client->lunch_finish_time = date("H:i:s", strtotime($request->lunch_finish_time));
        $client->visitor_per_hour =$request->visitor_per_hour;
        $client->first_name =$request->first_name;
        $client->last_name =$request->last_name;
        $client->email =$request->email;
        $client = $client->save();
       
        
        $user = User::create([
            'name' => $request['first_name'] .' '.$request['last_name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'role_id'=> 2,
        ]);

        return redirect()->route('admin.clients.index');
    }


    /**
     * Show the form for editing Client.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('client_edit')) {
            return abort(401);
        }
        if(Auth::user()->role_id ===1){
            $client = Client::findOrFail($id);
        }
        else
        {
            $that_client = Client::where('email','=',Auth::user()->email)->first();
            //if($that_client == 0){           
                $client = Client::findOrFail($that_client->id);
        }
        

        return view('admin.clients.edit', compact('client'));
    }

    /**
     * Update Client in storage.
     *
     * @param  \App\Http\Requests\UpdateClientsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientsRequest $request, $id)
    {
        if (! Gate::allows('client_edit')) {
            return abort(401);
        }
        $client = Client::findOrFail($id);
         //$client = new Client;
        $client->start_time = date("H:i:s", strtotime($request->start_time));
        $client->finish_time = date("H:i:s", strtotime($request->finish_time));
        $client->lunch_start_time = date("H:i:s", strtotime($request->lunch_start_time));
        $client->lunch_finish_time = date("H:i:s", strtotime($request->lunch_finish_time));
        $client->visitor_per_hour =$request->visitor_per_hour;
        $client->first_name =$request->first_name;
        $client->email =$request->email;
        $client->phone = $request->phone;
        $client = $client->update();

        //$client->update($request->all());



        return redirect()->route('admin.clients.index');
    }


    /**
     * Display Client.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('client_view')) {
            return abort(401);
        }
        $relations = [
            'appointments' => \App\Appointment::where('client_id', $id)->get(),
        ];

        $client = Client::findOrFail($id);

        return view('admin.clients.show', compact('client') + $relations);
    }


    /**
     * Remove Client from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('client_delete')) {
            return abort(401);
        }
        $client = Client::findOrFail($id);
        $client->delete();

        return redirect()->route('admin.clients.index');
    }

    /**
     * Delete all selected Client at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('client_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Client::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
