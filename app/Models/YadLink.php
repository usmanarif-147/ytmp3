<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YadLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'link',
    ];
}
