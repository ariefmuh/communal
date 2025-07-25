<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'picture',
        'author',
        'opening',
    ];
    use HasFactory;
}
