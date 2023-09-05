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
        'left_title',
        'right_title',
        'description_left',
        'description_right',
    ];
}
