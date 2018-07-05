<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMinhchungsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('minhchungs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ten_minh_chung');
            $table->string('ma_mc')->nullable();
            $table->unsignedInteger('tieuchi_id');
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
        Schema::dropIfExists('minhchungs');
    }
}
