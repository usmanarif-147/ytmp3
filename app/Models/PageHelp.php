<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageHelp extends Model
{
    use HasFactory;

    protected $fillable = [
        'lang_id',
        'page_id',
        'how_to_download_content',
        'why_use_content'
    ];
}
