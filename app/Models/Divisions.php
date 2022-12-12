<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Divisions extends Model
{
    public function districts()
    {
        return $this->hasMany(Districts::class, 'division_id', 'division_id')->with('thanas')
            ->select(['district_id', 'division_id', 'district_name']);
    }

}
