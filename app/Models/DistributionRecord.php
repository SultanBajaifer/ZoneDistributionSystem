<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DistributionRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipientID',
        'recrptionDate',
        'state',
        'recipientListID',
        'recipientName',
        'distriputionPointName',
        'distriputerName',
        'listName',
        'packageName',
        'packageID'
    ];
    protected $table = 'distriputionrecords';

    /**
     * Get the recipientDetail that owns the DistributionRecord
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recipientDetails(): BelongsTo
    {
        return $this->belongsTo(RecipientDetaile::class, 'recipientID', 'id');
    }

    /**
     * Get the package that owns the DistributionRecord
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class, 'packageID', 'id');
    }

    /**
     * Get the recupientList that owns the DistributionRecord
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recupientList(): BelongsTo
    {
        return $this->belongsTo(RecipientsList::class, 'recipientListID', 'id');
    }


}