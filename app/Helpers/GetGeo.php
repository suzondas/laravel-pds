<?php

namespace App\Helpers;

use App\Models\Divisions;
use App\Models\Districts;
use App\Models\Thanas;

class GetGeo
{
    public static function GetGeoAll()
    {

        return response()->json(Divisions::with('districts')->get(['division_id','division_name']));
    }
    public static function GetGeoByDivision($divisionId)
    {
        $data = new \stdClass();
        $data->divisions = Divisions::find($divisionId);
//        var_dump($data->district->district_name);exit;
        return $data;
    }
}

?>
