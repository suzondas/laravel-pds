<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion_particulars extends Model
{
    use HasFactory;
    protected $table = 'promotion_particulars';
    protected $fillable = [
        'user_id',
        'designation_id',
        'promotion_date',
        'g_o_date',
        'grade'
    ];
}
