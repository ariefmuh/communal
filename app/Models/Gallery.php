<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_leader_id',
        'photo_path',
        'caption'
    ];

    public function teamLeader()
    {
        return $this->belongsTo(User::class, 'team_leader_id');
    }
}
