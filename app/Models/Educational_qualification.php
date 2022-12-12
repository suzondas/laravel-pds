<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Educational_qualification extends Model
{
    use HasFactory;
    protected $table = 'educational_qualification';
    protected $fillable = [
        'user_id',
        'institute',
        'principle_subject',
        'degree_id',
        'pass_year',
        'division',
        'gpa_class',
        'distinction'
    ];
}
