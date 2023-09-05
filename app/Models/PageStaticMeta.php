<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageStaticMeta extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'robots',
        'canonical',
        'item_prop_name',
        'item_prop_image',
        'og_type',
        'og_title',
        'og_image',
    ];
}
