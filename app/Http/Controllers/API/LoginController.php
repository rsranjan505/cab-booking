<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function mobile_login(Request $request) {

        $request->validate([
            'mobile' => 'required|numeric'
        ]);
        $driver = Driver::where('mobile', $request->mobile)->first();

        if (!$driver) {
            return bad(null, 'Invalid mobile number');
        }
        else if ($driver->is_active != 1) {
            return bad(null, 'Your account is not approved yet');
        }
        else if ($driver->access_code != $request->access_code) {
            return bad(null, 'Your account is not approved yet');
        }
        return ok($driver);
    }
}
