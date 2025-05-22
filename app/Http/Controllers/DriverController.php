<?php

namespace App\Http\Controllers;

use App\Http\Requests\DriverRequest;
use App\Models\Country;
use App\Models\Driver;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $drivers = Driver::where('is_active',1)->with('country')->get();
        return Inertia::render('Drivers',['drivers'=>$drivers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::all();
        return Inertia::render('DriversCreate',['countries'=>$countries]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required|numeric|digits:10',

        ],[
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'mobile.required' => 'Mobile is required',
        ]);
        $request['status'] = 'pending';
        $request['is_active'] = 1;

        $driver = new Driver();
        $driver->create($request->all());

        return to_route('drivers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Driver $driver)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Driver $driver)
    {
        $countries = Country::all();
        $driver = Driver::where('id',$driver->id)->with('country')->first();
        return Inertia::render('DriversEdit',['countries'=>$countries,'driver'=>$driver]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Driver $driver)
    {
         $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required|numeric|digits:10',

        ],[
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'mobile.required' => 'Mobile is required',
        ]);

        $driver->update($request->all());
        return to_route('drivers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Driver $driver)
    {
        //
    }
}
