<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Address_information extends Model
{
    public static function boot()
    {
        parent::boot();

        self::creating(function (Address_information $model) {
            $model->user_id = Auth::id();
        });

    }

    use HasFactory;
    protected $table = 'address_information';
    protected $primaryKey = 'id';
    protected $guarded = [];
//    protected $fillable = [ 'user_id', 'house_permanent', 'village_permanent', 'post_office_permanent', 'upazila_permanent', 'district_permanent', 'contact_permanent', 'house_present', 'village_present', 'post_office_present', 'upazila_present', 'district_present', 'contact_present', 'created_at', 'updated_at'];
}
