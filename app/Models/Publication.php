<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;
    protected $table =  'Publication';
    protected $fillable = [
        "user_id",
        "type_of_publication",
        "description",
        "date"
    ];
}
