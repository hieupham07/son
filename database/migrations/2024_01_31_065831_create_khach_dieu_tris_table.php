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
        Schema::create('khach_dieu_tris', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('khach_hang_id')->nullable();
            $table->foreign('khach_hang_id')->references('id')->on('khach_hangs')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedInteger('goi_d_t_id')->nullable();
            $table->foreign('goi_d_t_id')->references('id')->on('goi_dieu_tris')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedInteger('goi_dieu_tri_id')->nullable();
            $table->foreign('goi_dieu_tri_id')->references('id')->on('khach_hang_gois')->onDelete('cascade')->onUpdate('cascade');

            $table->smallInteger('so_buoi_con')->nullable();
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
        Schema::dropIfExists('khach_dieu_tris');
    }
};
