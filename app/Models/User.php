<?php

namespace App\Models;

use App\Constants\Roles;
use App\Models\Product;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function sales():HasMany
    {
        return $this->hasMany(Invoice::class, 'user_id');
    }

    public function purchases():HasMany
    {
        return $this->hasMany(Invoice::class, 'customer_id');
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function getStatusAttribute(): string
    {
        return $this->attributes['enabled'] ? trans('common.status.enabled') : trans('common.status.disabled');
    }

    public function getIsAdminAttribute(): bool
    {
        return $this->attributes['is_admin'] = $this->hasRole(Roles::ADMIN);
    }

    public function getIsCustomerAttribute(): bool
    {
        return $this->attributes['is_customer'] = $this->hasRole(Roles::ADMIN);
    }

    public function scopeWhereIsAdmin(Builder $query): Builder
    {
        return $query->whereHas('roles', function ($query) {
            $query->where('name', Roles::ADMIN);
        });
    }

    public function toggle(): void
    {
        $this->enabled = !$this->enabled;
    }

    public function hasRole(string $roleName): bool
    {
        if (!$this->roles) {
            $this->load('roles');
        }

        return $this->roles->contains(function (Role $role) use ($roleName) {
            return $role->name === $roleName;
        });
    }

    public function countNotifications(): int
    {
        return $this->unreadNotifications()->count();
    }

    public function hasNotifications(): bool
    {
        return $this->countNotifications() > 0;
    }

    /**
     * Route notifications for the Slack channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForSlack($notification)
    {
        return config('slack.webhook');
    }
}
