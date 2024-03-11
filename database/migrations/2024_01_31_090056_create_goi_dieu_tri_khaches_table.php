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
        Schema::create('goi_dieu_tri_khaches', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('khach_hang_id')->nullable();
            $table->foreign('khach_hang_id')->references('id')->on('khach_hangs')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('goi_dt_id')->nullable();
            $table->foreign('goi_dt_id')->references('id')->on('goi_dieu_tris')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('trang_thai',['1','0'])->default('1');
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
        Schema::dropIfExists('goi_dieu_tri_khaches');
    }
};
