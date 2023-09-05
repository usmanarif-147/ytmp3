<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $langs = [
            [
                'name' => 'English',
                'lang' => 'en',
                'is_content_uploaded' => 0,
                'status' => 0,
            ],
            [
                'name' => 'Spanish',
                'lang' => 'es',
                'is_content_uploaded' => 0,
                'status' => 0,
            ],
            [
                'name' => 'Germen',
                'lang' => 'de',
                'is_content_uploaded' => 0,
                'status' => 0,
            ],
            [
                'name' => 'French',
                'lang' => 'fre',
                'is_content_uploaded' => 0,
                'status' => 0,
            ],
        ];

        foreach ($langs as $lang) {
            Language::create($lang);
        }
    }
}
