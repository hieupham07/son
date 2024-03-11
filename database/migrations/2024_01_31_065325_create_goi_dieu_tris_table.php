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
        Schema::create('goi_dieu_tris', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ten');
            $table->text('mo_ta')->nullable();
            $table->decimal('gia',18,0)->nullable();
            $table->decimal('giam_gia',18,0)->nullable();
            $table->smallInteger('so_buoi')->nullable();
            $table->text('ghi_chu')->nullable();
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
        Schema::dropIfExists('goi_dieu_tris');
    }
};
