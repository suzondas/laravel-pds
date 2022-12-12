<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service_history extends Model
{
    use HasFactory;
    protected $table = "Service_history";
    protected $fillable = [
        'user_id',
        'designation_id',
        'office_id',
        'from',
        'to'
    ];

}
