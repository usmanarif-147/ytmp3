<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageOldSlug extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_id',
        'old_slug'
    ];
}
