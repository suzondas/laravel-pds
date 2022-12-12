<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language_information extends Model
{
    use HasFactory;
    protected $table='language_information';
    protected $fillable=['user_id','language','read','write','speak'];
}
