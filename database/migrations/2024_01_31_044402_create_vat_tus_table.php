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
        Schema::create('vat_tus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ten');
            $table->text('mo_ta')->nullable();
            $table->unsignedInteger('loai_id')->nullable();
            $table->foreign('loai_id')->references('id')->on('loai_vat_tus')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('goi_id')->nullable();
            $table->foreign('goi_id')->references('id')->on('dong_gois')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamp('sua')->nullable();
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
        Schema::dropIfExists('vat_tus');
    }
};
