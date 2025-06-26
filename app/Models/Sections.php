<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sections extends Model
{
    protected $fillable = [
        'blog_id',
        'image',
        'title',
        'description',
    ];
    use HasFactory;
}
