<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RecipientDetaile extends Model
{
    use HasFactory;

    protected $table = 'RecipientDetailes';

    protected $fillable = [
        'id',
        'name',
        'phoneNum',
        'barcode',
        'familyCount',
        'addressID',
        'distriputionPointID',
        'birthday',
        'averageSalary',
        'workFor',
        'passportNum',
        'socialStatus',
        'residentType',
        'image'
    ];
    /**
     * Get the Address that owns the Recipient
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Address(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'addressID', 'id');
    }
    /**
     * Get the DistibtionPoint that owns the Recipient
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function DistributionPoint(): BelongsTo
    {
        return $this->belongsTo(DistributionPoint::class, 'distriputionPointID', 'id');
    }
    /**
     * The RecipientLists that belong to the Recipient
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function RecipientsList(): BelongsToMany
    {
        return $this->belongsToMany(RecipientsList::class, 'RecipientDetailes_RecipientsList', 'RecipientDetaileID', 'RecipientListID');
    }

    /**
     * Get all of the distriputionRecords for the RecipientDetaile
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function distriputionRecords(): HasMany
    {
        return $this->hasMany(DistributionRecord::class, 'recipientID', 'id');
    }



}