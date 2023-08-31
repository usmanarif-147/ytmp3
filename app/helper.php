<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('isImageExist')) {
    function isImageExist($image)
    {
        if ($image) {
            if (Storage::exists('public/' . $image)) {
                // if (request()->secure()) {
                //     return 'public/storage/' . $image;
                // } else {
                return 'storage/' . $image;
                // }
            } else {
                // if (request()->secure()) {
                //     return 'public/avatar.png';
                // } else {
                return 'avatar.png';
                // }
            }
        }
        // if (request()->secure()) {
        //     return 'public/avatar.png';
        // } else {
        return 'avatar.png';
        // }
    }
}
