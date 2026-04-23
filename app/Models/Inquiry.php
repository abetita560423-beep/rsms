<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'sender_id',
        'receiver_id',
        'message',
        'status',
        'parent_id',
    ];

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function replies()
    {
        return $this->hasMany(Inquiry::class, 'parent_id')->orderBy('created_at', 'asc');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Inquiry::class, 'parent_id');
    }
}
