<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncidentAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'incident_id',
        'team_id',
        'assigned_at',
        'status',
        'notes',
    ];

    protected $casts = [
        'assigned_at' => 'datetime',
    ];

    /**
     * Get the incident associated with the assignment.
     */
    public function incident()
    {
        return $this->belongsTo(Incident::class, 'incident_id');
    }

    /**
     * Get the response team associated with the assignment.
     */
    public function team()
    {
        return $this->belongsTo(ResponseTeam::class, 'team_id');
    }
}
