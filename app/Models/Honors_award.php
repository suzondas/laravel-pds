<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Honors_award extends Model
{
    use HasFactory;
    protected $table="honors_award";
    protected $fillable=['user_id','title','ground','date'];
}
