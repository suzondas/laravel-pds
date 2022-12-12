<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Degrees extends Model
{
	use HasFactory;

    public $timestamps = true;

    protected $table = 'degrees';

    protected $fillable = ['name'];

}
