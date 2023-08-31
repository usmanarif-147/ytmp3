<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageMeta extends Model
{
    use HasFactory;

    protected $fillable = [
        'lang_id',
        'page_id',
        'meta_title',
        'meta_description'
    ];
}
