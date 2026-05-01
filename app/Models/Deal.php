<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    protected $table = 'transactions';

    public const STATUS_PENDING = 'pending';
    public const STATUS_BUYER_CONFIRMED = 'buyer_confirmed';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_CANCELLED = 'cancelled';

    protected $fillable = [
        'property_id',
        'buyer_id',
        'seller_id',
        'inquiry_id',
        'amount',
        'status',
        'seller_note',
        'buyer_confirmed_at',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function inquiry()
    {
        return $this->belongsTo(Inquiry::class);
    }
}
