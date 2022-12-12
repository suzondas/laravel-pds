<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use App\Traits\HasSignature;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasSignature;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'name_bangla',
        'empid',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url','signature_url'
    ];

    public function forceFill(array $attributes)
    {
        return static::unguarded(function () use ($attributes) {
            return $this->fill($attributes);
        });

    }

    public function general_information()
    {
        return $this->hasOne(General_information::class)->withDefault(function () {
            return new General_information();
        });
    }

    public function personal_information()
    {
        return $this->hasOne(Personal_information::class)->withDefault(function () {
            return new personal_information();
        });
    }

    public function address_information()
    {
        return $this->hasOne(Address_information::class)->withDefault(function () {
            return new Address_information();
        });
    }

    public function spouse_information()
    {
        return $this->hasOne(Spouse_information::class)->withDefault(function () {
            return new spouse_information();
        });
    }

    public function children_information()
    {
        return $this->hasMany(children_information::class);
    }

}
