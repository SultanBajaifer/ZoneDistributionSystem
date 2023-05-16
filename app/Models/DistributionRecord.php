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
        'listName',
        'distriputionPointName',
        'distriputerName',
        'packageName',
        'packageID'
    ];
    protected $table = 'DistriputionRecords';

    /**
     * Get the recipientDetail that owns the DistributionRecord
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recipientDetail(): BelongsTo
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



}