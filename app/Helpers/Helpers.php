<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class Helpers
{
    /**
     * Country Fetch Function
    */

    public static function getCountry()
    {
        $countries = DB::table('countries')->get();
        return $countries;
    }
}
