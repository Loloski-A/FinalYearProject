<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponseTeam extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'team_type',
        'contact_phone',
        'contact_email',
        'status',
    ];

    /**
     * Get the members of the response team.
     */
    public function members()
    {
        return $this->hasMany(TeamMember::class, 'team_id');
    }

    /**
     * Get the incident assignments for the team.
     */
    public function assignments()
    {
        return $this->hasMany(IncidentAssignment::class, 'team_id');
    }
}
