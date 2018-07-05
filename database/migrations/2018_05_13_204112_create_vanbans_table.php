<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVanbansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vanbans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ten_van_ban')->nullable();
            $table->string('so_van_ban')->nullable();
            $table->string('noi_ban_hanh')->nullable();
            $table->date('ngay_thang_nam')->nullable();
            $table->string('file')->nullable();
            $table->unsignedInteger('minhchung_id');
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
        Schema::dropIfExists('vanbans');
    }
}
