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
        Schema::create('page_dynamic_metas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lang_id')->constrained('languages');
            $table->foreignId('page_id')->constrained('pages');
            $table->text('meta_description');
            $table->text('item_prop_description');
            $table->text('og_description');
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
        Schema::dropIfExists('page_dynamic_metas');
    }
};
