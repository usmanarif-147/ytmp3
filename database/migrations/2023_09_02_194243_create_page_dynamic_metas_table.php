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

            $table->string('meta_title');
            $table->text('meta_description');

            $table->string('item_prop_name');
            $table->text('item_prop_description');
            $table->string('item_prop_image');

            $table->string('og_type');
            $table->string('og_title');
            $table->string('og_image');
            $table->text('og_description');
            $table->string('og_locale');
            $table->string('og_url');

            $table->string('canonical');
            $table->string('robots');

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
