<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Driver;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::with('driver')->get();
        return Inertia::render('Bookings',['bookings'=>$bookings]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $drivers = Driver::where('is_active',1)->get();
        return Inertia::render('BookingsCreate',['drivers'=>$drivers]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'driver_id' => 'required',
            'name' => 'required',
            'mobile' => 'required|numeric|digits:10',
        ]);

        $booking = new Booking();
        $booking->create($request->all());
        return to_route('bookings.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        $booking = Booking::where('id',$booking->id)->with('driver')->first();
        $drivers = Driver::where('is_active',1)->get();
        return Inertia::render('BookingsEdit',['booking'=>$booking,'drivers'=>$drivers]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'driver_id' => 'required',
            'name' => 'required',
            'mobile' => 'required|numeric|digits:10',
        ]);
        $booking->update($request->all());
        return to_route('bookings.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return to_route('bookings.index');
    }
}
