<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_helps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lang_id')->constrained('languages');
            $table->foreignId('page_id')->constrained('pages');
            $table->mediumText('how_to_download_content');
            $table->mediumText('why_use_content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_helps');
    }
};
