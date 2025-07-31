<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'team_id',
        'incident_id',
        'type',
        'title',
        'message',
        'read_status',
        'sent_at',
    ];

    protected $casts = [
        'read_status' => 'boolean',
        'sent_at' => 'datetime',
    ];

    /**
     * Get the user the notification is for (if specific).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the team the notification is for (if team-specific).
     */
    public function team()
    {
        return $this->belongsTo(ResponseTeam::class, 'team_id');
    }

    /**
     * Get the incident related to the notification.
     */
    public function incident()
    {
        return $this->belongsTo(Incident::class, 'incident_id');
    }
}
