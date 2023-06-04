<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RecipientsList extends Model
{
    use HasFactory;
    protected $table = 'recipientslist';

    protected $fillable = [
        'id',
        'name',
        'creationDate',
        'state',
        'note',
        'distriputionPointID',
        'is_send'

    ];
    /**
     * The Recipients that belong to the RecipientsList
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Recipients(): BelongsToMany
    {
        return $this->belongsToMany(RecipientDetaile::class, 'distriputionrecords', 'recipientListID', 'recipientID');
    }
    /**
     * The DistributionPoints that belong to the RecipientsList
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    /**
     * Get the user that owns the RecipientsList
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function distributionPoint(): BelongsTo
    {
        return $this->belongsTo(DistributionPoint::class, 'distriputionPointID');
    }

    /**
     * Get all of the distributionRecords for the RecipientsList
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function distributionRecords(): HasMany
    {
        return $this->hasMany(DistributionRecord::class, 'recipientListID');
    }


}