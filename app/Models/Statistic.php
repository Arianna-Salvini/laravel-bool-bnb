<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Statistic extends Model
{
    use HasFactory;

    protected $fillable = ['apartment_id', 'ip_address', 'date', 'tot_messages'];

    /**
     * Get the apartment that owns the Statistic
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function apartment(): BelongsTo
    {
        return $this->belongsTo(Apartment::class);
    }
}
