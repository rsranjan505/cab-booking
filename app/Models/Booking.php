<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';
    protected $fillable = ['driver_id', 'name', 'email', 'mobile', 'booking_from', 'booking_to', 'booking_date', 'booking_time', 'booking_charge', 'booking_status', 'payment_status', 'completed_at', 'vechile_number', 'is_cancel', 'cancel_reason'];
    protected $dates = ['completed_at','created_at', 'updated_at'];

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id', 'id');
    }
}
