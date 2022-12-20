<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foreign_travel extends Model
{
    use HasFactory;
    protected $table = 'foreign_travel';
    protected $fillable=[
        "user_id",
        "country_id",
        "purpose",
        "from",
        "to",
        "duration"
    ];
}
