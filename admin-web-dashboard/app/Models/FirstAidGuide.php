<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FirstAidGuide extends Model
{
    use HasFactory;

    protected $fillable = [
        'incident_type',
        'title',
        'content',
        'language',
        'created_by',
    ];

    /**
     * Get the user (admin) who created the guide.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
