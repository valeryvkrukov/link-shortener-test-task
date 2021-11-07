<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortenedLink extends Model
{
    use HasFactory;

    protected $table = 'shortened_links';

    protected $fillable = ['original_url', 'shortened_link'];
}
