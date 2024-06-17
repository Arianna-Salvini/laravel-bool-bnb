<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
        'slug',
        'description',
        'image',
        'rooms',
        'beds',
        'bathrooms',
        'square_meters',
        'address',
        'street_number',
        'country_code',
        'city',
        'zip_code',
        'latitude',
        'longitude',
        'visibility',
    ];

    /**
     * Get the user that owns the Apartment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The services that belong to the Apartment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class);
    }

    /**
     * The sponsorships that belong to the Apartment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sponsorships(): BelongsToMany
    {
        return $this->belongsToMany(Sponsorship::class);
    }

    /**
     * Get all of the messages for the Apartment
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Get all of the statistics for the Apartment
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function statistics(): HasMany
    {
        return $this->hasMany(Statistic::class);
    }
}
