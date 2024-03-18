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
        Schema::create('phieu_thu_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('phieu_thu_id')->nullable();
            $table->foreign('phieu_thu_id')->references('id')->on('phieu_thus')->onDelete('cascade')->onUpdate('cascade');
            $table->string('tieu_de')->nullable();
            $table->string('content')->nullable();
            $table->decimal('gia_tien',18,0)->nullable();
            $table->smallInteger('soluong_goi')->nullable();
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
        Schema::dropIfExists('phieu_thu_details');
    }
};
