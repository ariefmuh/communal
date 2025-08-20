<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityProgram extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_leader_id',
        'program_name',
        'description',
        'support_needed',
        'event_date',
        'location',
        'proposal',
        'status'
    ];

    protected $casts = [
        'event_date' => 'datetime'
    ];

    public function teamLeader()
    {
        return $this->belongsTo(User::class, 'team_leader_id');
    }
}
