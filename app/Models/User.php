<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    public const ROLE_ADMIN = 'admin';
    public const ROLE_STAFF = 'staff';
    public const ROLE_BUYER = 'buyer';
    public const ROLE_SELLER = 'seller';

    public const ROLES = [
        self::ROLE_ADMIN,
        self::ROLE_STAFF,
        self::ROLE_BUYER,
        self::ROLE_SELLER,
    ];

    public const CUSTOMER_ROLES = [
        self::ROLE_BUYER,
        self::ROLE_SELLER,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function dashboardRouteName(): string
    {
        return match ($this->role) {
            self::ROLE_ADMIN => 'dashboard.admin',
            self::ROLE_STAFF => 'dashboard.staff',
            self::ROLE_SELLER => 'dashboard.seller',
            default => 'dashboard',
        };
    }

    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }

    public function unreadNotifications(): HasMany
    {
        return $this->hasMany(Notification::class)->whereNull('read_at');
    }

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isStaff(): bool
    {
        return $this->role === self::ROLE_STAFF;
    }

    public function isSeller(): bool
    {
        return $this->role === self::ROLE_SELLER;
    }

    public function isBuyer(): bool
    {
        return $this->role === self::ROLE_BUYER;
    }

    public function canManageProperties(): bool
    {
        return in_array($this->role, [self::ROLE_ADMIN, self::ROLE_STAFF, self::ROLE_SELLER], true);
    }

    public function boughtTransactions(): HasMany
    {
        return $this->hasMany(Deal::class, 'buyer_id');
    }

    public function soldTransactions(): HasMany
    {
        return $this->hasMany(Deal::class, 'seller_id');
    }
}
