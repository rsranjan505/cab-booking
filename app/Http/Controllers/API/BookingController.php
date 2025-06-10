<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Dotenv\Util\Str;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function add_booking(Request $request)
    {
        $request->validate([
            'driver_id' => 'required',
            'name' => 'required',
            'mobile' => 'required|numeric',
            'booking_from' => 'required',
            'booking_to' => 'required',
            'booking_date' => 'required',
        ],[
            'driver_id.required' => 'Driver is required',
            'name.required' => 'Name is required',
            'mobile.required' => 'Mobile is required',
            'booking_from.required' => 'Booking from is required',
            'booking_to.required' => 'Booking to is required',
            'booking_date.required' => 'Booking date is required',
        ]);
        $request['booking_status'] = isset($request['booking_status']) ? $request['booking_status'] : 'pending';
        if($request['booking_status'] == 'running'){
            $request['booking_time'] = date('H:i:s');
        }

        $booking = new Booking();
        $booking->create($request->all());
        return ok($booking, 'Booking added successfully');
    }

    public function booking_update(String $id)
    {
        $booking = Booking::where('id', $id)->first();
        $booking->update(['booking_status' => 'completed','completed_at' => date('Y-m-d H:i:s')]);
        return ok($booking, 'Booking updated successfully');
    }

    public function booking_delete(String $id)
    {
        $booking = Booking::where('id', $id)->first();
        if(!$booking){
            return bad('Booking not found');
        }
        if($booking->booking_status == 'completed'){
            return bad('Booking already completed');
        }
        $booking->delete();
        return ok($booking, 'Booking deleted successfully');
    }

    public function booking_list($driver_id)
    {
        $bookings= Booking::where('driver_id', $driver_id)->latest()->get();
        return ok($bookings, 'Booking list');
    }

    public function booking_details(String $id)
    {
        $booking = Booking::where('id', $id)->with('driver')->first();
        return ok($booking, 'Booking details');
    }


    // public function running_booking()
    // {
    //     $bookings= Booking::where('booking_status', 'running')->first();
    //     return ok($bookings, 'current Booking');
    // }


    // dashborad items

    public function dashborad_items($driver_id)
    {
        $dashboard_items = [
            'upcoming_bookings' => Booking::where('driver_id', $driver_id)->where('booking_status', 'booked')->where('booking_date', '>=', date('Y-m-d'))->count(),
            'completed_bookings' => Booking::where('booking_status', 'completed')->count(),
        ];

        $bookings = Booking::where('booking_status', 'running')->first();
        if($bookings){
            $dashboard_items['current_booking'] = $bookings;
        }

        return ok($dashboard_items, 'dashboard items');

    }
}
