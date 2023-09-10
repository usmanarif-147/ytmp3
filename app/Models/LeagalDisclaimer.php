<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeagalDisclaimer extends Model
{
    use HasFactory;

    protected $fillable = [
        'lang_id',
        'title',
        'description',
    ];
}
