<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    protected $fillable = [
        'user_id',
        'category',
        'proposal',
        'progress',
    ];

    use HasFactory;
}
