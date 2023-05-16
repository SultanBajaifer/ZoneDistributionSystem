<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;



    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'userName',
        'password',
        'email',
        'userType',
        'addressID'
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * Get the user that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Address(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'addressID', 'id');
    }
    /**
     * Get all of the complaints for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function complaints(): HasMany
    {
        return $this->hasMany(Complaint::class, 'userID');
    }

    /**
     * Get all of the DistributionPoints for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function DistributionPoints(): HasMany
    {
        return $this->hasMany(DistributionPoint::class, 'userID');
    }
}