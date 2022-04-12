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
        Schema::create('dzikirs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('long_title');
            $table->text('description');
            $table->foreignId('categories');
            $table->foreignId('menu_id')->constrained('menus')->onDelete('cascade');
            $table->text('doa_latin');
            $table->text('doa_arab');
            $table->text('description_doa');
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
        Schema::dropIfExists('dzikirs');
    }
};
