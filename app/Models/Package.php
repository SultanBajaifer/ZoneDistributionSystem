<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Package extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'note'
    ];

    /**
     * Get all of the items for the Pacakge
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Items(): HasMany
    {
        return $this->hasMany(Item::class, 'packageID');
    }

    /**
     * Get all of the DistributionRecord for the Package
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function DistributionRecord(): HasMany
    {
        return $this->hasMany(DistributionRecord::class, 'foreign_key', 'local_key');
    }
}