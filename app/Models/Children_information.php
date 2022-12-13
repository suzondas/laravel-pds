<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class children_information extends Model
{
    use HasFactory;
    protected $primaryKey = "id";
    protected $table = 'children_information';
    protected $fillable = [
        'user_id',
        'name',
        'name_bangla',
        'date_of_birth',
        'sex',
        'special_child'
    ];

    public $timestamps = true;

}
