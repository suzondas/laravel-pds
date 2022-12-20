<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Local_training extends Model
{
    use HasFactory;
    protected $table = 'local_training';
    protected $fillable = [
        "user_id",
        "course_title",
        "institution",
        "position",
        "from",
        "to",
        "duration"];

}
