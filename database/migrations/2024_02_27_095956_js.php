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
        Schema::create('js', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->longText('js1')->nullable()->comment('首頁置頂廣告');
            $table->longText('js2')->nullable()->comment('列表和文章內側欄廣告');
            $table->longText('js3')->nullable()->comment('文章內置頂廣告');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('js');
    }
};
