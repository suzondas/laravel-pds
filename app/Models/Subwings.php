<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subwings extends Model
{
    use HasFactory;
    protected $fillable=[
        'wing_id',
        'name',
        'name_bangla'
    ];

    public $timestamps = true;
}
