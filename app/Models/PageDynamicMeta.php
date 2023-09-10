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
        'meta_title',
        'meta_description',
        'item_prop_name',
        'item_prop_image',
        'item_prop_description',
        'og_type',
        'og_title',
        'og_image',
        'og_description',
        'og_locale',
        'og_url',
        'canonical',
        'robots'
    ];
}
