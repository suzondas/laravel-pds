<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foreign_training extends Model
{
    use HasFactory;
    protected $table = 'foreign_training';
    protected $fillable = [
        "user_id",
        "course_title",
        "country_id",
        "from",
        "to",
        "duration"];
}
