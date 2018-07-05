<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignkeyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tieuchis', function (Blueprint $table) {
            $table->foreign('tieuchuan_id')->references('id')->on('tieuchuans')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('minhchungs', function (Blueprint $table) { 
            $table->foreign('tieuchi_id')->references('id')->on('tieuchis')->onDelete('cascade');
        });

        Schema::table('vanbans', function (Blueprint $table) { 
            $table->foreign('minhchung_id')->references('id')->on('minhchungs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
    }
}
