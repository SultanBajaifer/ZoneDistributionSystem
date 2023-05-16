<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Address extends Model
{
    use HasFactory;

    protected $fillable = ([
        'country' => 'string',
        'city',
        'neighborhood'

    ]);

    /**
     * Get all of the Users for the Address
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Users(): HasMany
    {
        return $this->hasMany(User::class, 'AddressID', 'id');
    }
    /**
     * Get all of the DistributionPoints for the Address
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function DistributionPoints(): HasMany
    {
        return $this->hasMany(DistributionPoint::class, 'AddressID', 'id');
    }

    /**
     * Get all of the Recipients for the Address
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Recipients(): HasMany
    {
        return $this->hasMany(RecipientDetaile::class, 'addressID', 'id');
    }
}