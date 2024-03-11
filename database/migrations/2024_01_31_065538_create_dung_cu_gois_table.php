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
        Schema::create('dung_cu_gois', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('goi_id')->nullable();
            $table->foreign('goi_id')->references('id')->on('goi_dieu_tris')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('vat_tu_id')->nullable();
            $table->foreign('vat_tu_id')->references('id')->on('vat_tus')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('dung_cu_gois');
    }
};
