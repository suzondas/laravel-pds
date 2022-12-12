<?php

namespace App\Helpers;

use App\Models\Districts;
use App\Models\Thanas;

class GetDistrict
{
    public static function GetAllDistricts(){
        return Districts::whereNotIn('division_id',['99'])->orderBy('district_name','asc')->get();
    }
    public static function GetDistrictDtl($districtId)
    {
        $data = new \stdClass();
        $data->district = Districts::find($districtId);
        $data->thanas = Thanas::where('DISTRICT_ID', $districtId)->get();
//        var_dump($data->district->district_name);exit;
        return $data;
    }
}

?>
