<?php
namespace App\Helpers;

use App\Models\Thanas;
use App\Models\Districts;
class GetThanas
{
    public static function GetThanas($districtId){
        return Thanas::where(['district_id'=>$districtId])->get();
    }
    public static function GetThanaDtl($thanaId)
    {
        $data = new \stdClass();
        $data->thana = Thanas::find($thanaId);
        $data->district = Districts::find($data->thana["DISTRICT_ID"]);
        return $data;
    }
}

?>
