<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getIsActiveAttribute(){
        if(!$this->lastActiveUserSubscription){
            return false;
        }
        $dateNow = Carbon::now();
        $dateExpired = Carbon::create($this->lastActiveUserSubscription->expired_date);
        return $dateNow->lessThanOrEqualTo($dateExpired);
    }

    /**
     * Get the lastActiveSubsciption associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function lastActiveUserSubscription(): HasOne
    {
        return $this->hasOne(UserSubscription::class)->wherePaymentStatus('paid')->latest();
    }

    // public function hasRole($role)
    // {
    //     // Mendapatkan semua peran dari pengguna ini
    //     $roles = $this->roles()->pluck('name')->toArray();

    //     // Memeriksa apakah peran yang diminta ada di dalam array peran pengguna
    //     return in_array($role, $roles);
    // }

}
