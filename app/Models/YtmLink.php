<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YtmLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'link',
    ];
}
