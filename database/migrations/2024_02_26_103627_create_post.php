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
        Schema::create('post', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title')->nullable();
            $table->string('post_text')->nullable();
            $table->string('post_url')->nullable();
            $table->string('post_tab')->nullable();
            $table->string('website_name')->nullable();
            $table->string('website_url')->nullable();
            $table->string('imager_title')->nullable();
            $table->string('imager1')->nullable();
            $table->string('imager2')->nullable();
            $table->string('imager3')->nullable();
            $table->integer('area_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post');
    }
};
