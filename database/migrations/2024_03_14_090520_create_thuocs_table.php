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
        Schema::create('thuocs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ten');
            $table->decimal('gia',18,0)->nullable();
            $table->decimal('giam_gia',18,0)->nullable();
            $table->unsignedInteger('dong_goi_id')->nullable();
            $table->foreign('dong_goi_id')->references('id')->on('dong_gois')->onDelete('cascade')->onUpdate('cascade');
            $table->text('content')->nullable();
            $table->text('ghi_chu')->nullable();
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
        Schema::dropIfExists('thuocs');
    }
};