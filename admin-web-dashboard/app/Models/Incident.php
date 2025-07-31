<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    use HasFactory;

    // Define which attributes are mass assignable
    protected $fillable = [
        'user_id',
        'incident_type',
        'severity',
        'description',
        'latitude',
        'longitude',
        'location_name',
        'contact_info',
        'status',
        'reported_at',
        'resolved_at',
    ];

    // Define attribute casting for automatic date conversion
    protected $casts = [
        'reported_at' => 'datetime',
        'resolved_at' => 'datetime',
    ];

    /**
     * Get the user who reported the incident.
     * This defines a one-to-many inverse relationship.
     */
    public function reporter()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the assignments for the incident.
     * This defines a one-to-many relationship.
     */
    public function assignments()
    {
        return $this->hasMany(IncidentAssignment::class, 'incident_id');
    }

    /**
     * Get the media files for the incident.
     * This defines a one-to-many relationship.
     */
    public function media()
    {
        return $this->hasMany(IncidentMedia::class, 'incident_id');
    }
}
