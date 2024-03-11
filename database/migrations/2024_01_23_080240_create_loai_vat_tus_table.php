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
        Schema::create('loai_vat_tus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ten');
            $table->text('mo_ta')->nullable();
            // $table->foreignId('dong_goi_id')->constrained('dong_gois');
            // $table->foreignId('user_id')->constrained('dong_gois')->cascadeOnDelete();
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
        Schema::dropIfExists('loai_vat_tus');
    }
};
