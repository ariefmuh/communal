<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    protected $fillable = [
        'nama',
        'no_wa',
        'alamat',
        'email',
        'request_file',
        'progress',
    ];

    use HasFactory;
}
