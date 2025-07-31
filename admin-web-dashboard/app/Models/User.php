<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_role',
        'status',
        'email_verified_at', // Ensure this is fillable if setting it manually
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the team member associated with the user (if they are a team member).
     */
    public function teamMember()
    {
        return $this->hasOne(TeamMember::class, 'user_id');
    }

    /**
     * Get the incidents reported by the user (if they are a bystander).
     */
    public function incidents()
    {
        return $this->hasMany(Incident::class, 'user_id');
    }

    /**
     * Get the notifications for the user.
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id');
    }
}
