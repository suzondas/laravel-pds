<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class General_information extends Model
{
    public static function boot()
    {
        parent::boot();

        self::creating(function (General_information $model) {
            $model->user_id = Auth::id();
        });

    }
    use HasFactory;
    protected $table = "general_information";
    protected $guarded = [];
//    protected $fillable = [ 'user_id', 'fathers_name', 'mothers_name', 'date_of_birth', 'date_of_prl', 'rank', 'home_dist', 'designation', 'office_name', 'order_date', 'join_date', 'gender', 'religion', 'marital_status', 'nid', 'freedom_fighter', 'email', 'mobile', 'created_at', 'updated_at'];
    protected $primaryKey = 'id';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
