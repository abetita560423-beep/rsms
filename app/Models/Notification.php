<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    use HasFactory;

    public const TYPE_NEW_INQUIRY = 'new_inquiry';
    public const TYPE_PAYMENT_REQUEST = 'payment_request';
    public const TYPE_DEAL_FINALIZED = 'deal_finalized';
    public const TYPE_PROPERTY_APPROVED = 'property_approved';
    public const TYPE_PROPERTY_REJECTED = 'property_rejected';
    public const TYPE_NEW_MESSAGE = 'new_message';
    public const TYPE_BUYER_CONFIRMED_PAYMENT = 'buyer_confirmed_payment';
    public const TYPE_TRANSACTION_FINALIZED = 'transaction_finalized';

    protected $fillable = [
        'user_id',
        'type',
        'message',
        'read_at',
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
