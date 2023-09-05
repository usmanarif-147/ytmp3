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
        Schema::create('page_static_metas', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('robots');
            $table->string('item_prop_name');
            $table->string('item_prop_image');
            $table->string('canonical');
            $table->string('og_type');
            $table->string('og_title');
            $table->string('og_image');
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
        Schema::dropIfExists('page_static_metas');
    }
};
