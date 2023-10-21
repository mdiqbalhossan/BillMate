<?php

namespace App\Helpers;

use App\Models\Estimate;
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

    /**
     * @throws \Exception
     */
    public static function generateEstimateNumber(): int
    {
        $uniqueNumber = random_int(1000, 9999); // Generate a random number

        while (Estimate::where('estimate_number', $uniqueNumber)->exists()) {
            $uniqueNumber = random_int(1000, 9999); // Regenerate if it already exists
        }

        return $uniqueNumber;
    }
}
