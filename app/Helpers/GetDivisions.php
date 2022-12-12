<?php

namespace App\Helpers;

use App\Models\Divisions;

class GetDivisions
{
    public static function GetDivisionDtl($divisionId)
    {
        $data = new \stdClass();
        $data->divisions = Divisions::find($divisionId);
//        var_dump($data->district->district_name);exit;
        return $data;
    }
}

?>
