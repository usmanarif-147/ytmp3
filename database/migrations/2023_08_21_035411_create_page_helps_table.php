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
            $table->string('left_title');
            $table->string('right_title');
            $table->longText('description_left');
            $table->longText('description_right');
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
