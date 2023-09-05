<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageDynamicMeta extends Model
{
    use HasFactory;

    protected $fillable = [
        'lang_id',
        'page_id',
        'meta_description',
        'item_prop_description',
        'og_description'
    ];
}
