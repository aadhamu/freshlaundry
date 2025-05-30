<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $fillable = [
        'customer_id', // add this if you don't already have it in DB & migration
        'name', 'email', 'phone', 'address',
        'service_type', 'pickup_date', 'pickup_time',
        'notes', 'status', 'delivery_option', 'instructions', 'agreeTerms', 'is_urgent', 'total_amount' 
    ];

    protected $casts = [
        'pickup_date' => 'datetime',
    ];

    /**
     * Get the customer (user) that owns the booking.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id'); // adjust foreign key if needed
    }

    
public function service(): BelongsTo
{
    return $this->belongsTo(Service::class);
}
}
