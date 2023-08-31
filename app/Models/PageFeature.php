<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageFeature extends Model
{
    use HasFactory;

    protected $fillable = [
        'lang_id',
        'page_id',
        'feature_title',
        'feature_image',
        'feature_description'
    ];
}
