<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Districts extends Model
{
    protected $primaryKey = 'district_id';
    public $incrementing = false;
    public function thanas()
    {
        return $this->hasMany(Thanas::class, 'district_id', 'district_id')
            ->select(['district_id', 'thana_id','thana_name']);
    }
}
