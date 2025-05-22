<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $table = 'drivers';
    protected $fillable = ['name', 'email', 'mobile', 'address', 'city', 'state', 'country_id', 'zip', 'is_own_vechile','vechile_type', 'vechile_number', 'vechile_color', 'vechile_model', 'vechile_capacity', 'status', 'is_active'];

    protected $dates = ['created_at', 'updated_at'];
    protected $casts = [
        'is_own_vechile' => 'boolean',
        'is_active' => 'boolean'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }


}
