<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class spouse_information extends Model
{
    public static function boot()
    {
        parent::boot();

        self::creating(function (spouse_information $model) {
            $model->user_id = Auth::id();

        });

    }
    use HasFactory;
    protected $table = 'spouse_information';
    protected $guarded = [];

}
