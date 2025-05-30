<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function update_driver(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required|numeric',

        ],[
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'mobile.required' => 'Mobile is required',
        ]);

        $driver = Driver::where('id', $request->id)->first();
        $driver->update($request->all());
        return ok($driver, 'Driver updated successfully');
    }
}
