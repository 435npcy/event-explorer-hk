<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    // Stripe payment_intent status
    // url: https://stripe.com/docs/payments/paymentintents/lifecycle#intent-statuses
    // requires_payment_method
    // requires_confirmation (optional)
    // requires_action
    // processing
    // requires_capture
    // canceled
    // succeeded

    const DRAFT = 'DRAFT';
    const PREPARED = 'PREPARED';
    const PROCESSING = 'PROCESSING';
    const SUCCEEDED = 'SUCCEEDED';
    const FAILED = 'FAILED';
    const CANCELED = 'CANCELED';


    protected $fillable = [
        'status',
        'total_amount',
        'stripe_payment_method',
    ];

    public function calculateTotalAmount()
    {
        return $this->items()->get()->reduce(function (?int $carry, $item) {
            return $carry + $item->sub_price * $item->quantity;
        }, 0);
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }
}