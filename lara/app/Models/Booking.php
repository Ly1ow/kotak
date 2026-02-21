<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $fillable = [
        'full_name',
        'phone',
        'hours',
        'skate_id',
        'skate_model',
        'skate_size',
        'has_own_skates',
        'total_amount',
        'is_paid',
        'payment_id'
    ];

    protected $casts = [
        'hours' => 'integer',
        'skate_size' => 'integer',
        'has_own_skates' => 'boolean',
        'is_paid' => 'boolean',
        'total_amount' => 'integer'
    ];

    public function skate(): BelongsTo
    {
        return $this->belongsTo(Skate::class);
    }

    public function calculateTotal(): int
    {
        $total = 300; // Входной билет
        
        if (!$this->has_own_skates && $this->skate_id) {
            $total += 150 * $this->hours;
        }
        
        return $total;
    }
}