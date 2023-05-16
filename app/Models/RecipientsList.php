<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class RecipientsList extends Model
{
    use HasFactory;
    protected $table = 'RecipientsList';

    protected $fillable = [
        'name',
        'creationDate',
        'state',
        'note'
    ];
    /**
     * The Recipients that belong to the RecipientsList
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Recipients(): BelongsToMany
    {
        return $this->belongsToMany(RecipientDetaile::class, 'RecipientDetailes_RecipientsList', 'recipientListID', 'recipientDetaileID');
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
        return $this->belongsTo(DistributionPoint::class, 'distributionPointID');
    }


}