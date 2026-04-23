<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    use HasFactory;

    public const TYPE_SALE = 'sale';
    public const TYPE_RENT = 'rent';

    public const STATUS_PENDING = 'pending';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_REJECTED = 'rejected';
    public const STATUS_SOLD = 'sold';
    public const STATUS_RENTED = 'rented';

    public const TYPES = [
        self::TYPE_SALE,
        self::TYPE_RENT,
    ];

    public const STATUSES = [
        self::STATUS_PENDING,
        self::STATUS_APPROVED,
        self::STATUS_REJECTED,
        self::STATUS_SOLD,
        self::STATUS_RENTED,
    ];

    public const CATEGORIES = [
        'house',
        'apartment',
        'villa',
        'condo',
        'townhouse',
        'commercial',
        'land',
    ];

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'price',
        'type',
        'category',
        'location',
        'image',
        'status',
        'bedrooms',
        'bathrooms',
        'sqft',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
        ];
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(PropertyImage::class);
    }

    public function primaryImage(): ?PropertyImage
    {
        return $this->images->firstWhere('is_primary', true) ?? $this->images->first();
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Deal::class);
    }
}
