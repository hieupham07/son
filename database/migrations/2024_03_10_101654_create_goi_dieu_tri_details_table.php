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
        Schema::create('goi_dieu_tri_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('goidieutri_id')->nullable();
            $table->foreign('goidieutri_id')->references('id')->on('goi_dieu_tris')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('vattu_id')->nullable();
            $table->foreign('vattu_id')->references('id')->on('vat_tus')->onDelete('cascade')->onUpdate('cascade');
            $table->smallInteger('so_luong')->nullable();
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
        Schema::dropIfExists('goi_dieu_tri_details');
    }
};
