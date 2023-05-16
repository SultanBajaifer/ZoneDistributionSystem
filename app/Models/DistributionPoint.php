<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DistributionPoint extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'state',
        'creation_date',
        'userID',
        'addressID'
    ];
    protected $table = 'DistributionPoints';

    /**
     * Get the address that owns the DistributionPoint
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'addressID', 'id');
    }

    /**
     * Get the user that owns the DistributionPoint
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userID', 'id');
    }

    /**
     * Get all of the Recipients for the DistributionPoint
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Recipients(): HasMany
    {
        return $this->hasMany(RecipientDetaile::class, 'distriputionPointID', 'id');
    }
}