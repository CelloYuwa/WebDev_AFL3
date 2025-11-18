<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'author', 'category', 'year', 'isbn',
        'description', 'cover_url', 'total_copy', 'available_copy', 'borrowed_copy'
    ];
}
