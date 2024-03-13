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
        Schema::create('phieu_thus', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ma_phieuthu')->nullable();
            $table->unsignedInteger('khach_hang_id')->nullable();
            $table->foreign('khach_hang_id')->references('id')->on('khach_hangs')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('goi_id')->nullable();
            $table->foreign('goi_id')->references('id')->on('goi_dieu_tris')->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('tien_thanhtoan',18,0)->nullable();
            $table->decimal('tien_con',18,0)->nullable();
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
        Schema::dropIfExists('phieu_thus');
    }
};