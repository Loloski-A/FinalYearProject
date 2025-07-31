<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncidentMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'incident_id',
        'file_path',
        'file_type',
        'description',
        'uploaded_at',
    ];

    protected $casts = [
        'uploaded_at' => 'datetime',
    ];

    /**
     * Get the incident that owns the media.
     */
    public function incident()
    {
        return $this->belongsTo(Incident::class, 'incident_id');
    }
}
