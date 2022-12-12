<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class personal_information extends Model
{
    public static function boot()
    {
        parent::boot();

        self::creating(function (personal_information $model) {
            $model->user_id = Auth::id();

        });

    }

    use HasFactory;
    protected $table = 'personal_information';

//    protected $fillable=['fathers_name_bangla','fathers_nid'];
    protected $guarded = [];
}
