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
        Schema::create('html_python', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->nullable();
            $table->longText('title_filter')->nullable()->comment('列表內的每一項的查詢關鍵字');
            $table->longText('body_filter')->nullable()->comment('列表的查詢關鍵字');
            $table->longText('post_filter')->nullable()->comment('文章的查詢關鍵字');;
            $table->longText('imager1_filter')->nullable();
            $table->longText('imager2_filter')->nullable();
            $table->longText('imager3_filter')->nullable();
            $table->longText('url')->nullable();
            $table->longText('connect_url')->nullable();
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
        Schema::dropIfExists('html_python');
    }
};
