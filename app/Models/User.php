<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role',
        'salon_id',
        'avatar',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
    ];

    // Relations
    public function salon()
    {
        return $this->belongsTo(Salon::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'client_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'client_id');
    }

    public function employee()
    {
        return $this->hasOne(Employee::class);
    }

    // Scopes
    public function scopeClients($query)
    {
        return $query->where('role', 'client');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Helpers
    public function isClient()
    {
        return $this->role === 'client';
    }

    public function isManager()
    {
        return $this->role === 'manager';
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}