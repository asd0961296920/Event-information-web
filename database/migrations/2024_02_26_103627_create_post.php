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
            $table->longText('title')->nullable();
            $table->longText('post_text')->nullable();
            $table->longText('post_url')->nullable();
            $table->longText('post_tab')->nullable();
            $table->longText('website_name')->nullable();
            $table->longText('website_url')->nullable();
            $table->longText('imager_title')->nullable();
            $table->longText('imager1')->nullable();
            $table->longText('imager2')->nullable();
            $table->longText('imager3')->nullable();
            $table->integer('area_id');
            $table->integer('html_python_id');
            $table->dateTime('event_date')->nullable()->comment('活動日期');
            
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
