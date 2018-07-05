<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTieuchisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tieuchis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ten_tieu_chi');
            $table->text('mo_ta')->nullable();
            $table->text('diem_manh')->nullable();
            $table->text('nhung_ton_tai')->nullable();
            $table->text('ke_hoach_cai_tien')->nullable();
            $table->tinyInteger('tu_danh_gia')->default(1);
            $table->tinyInteger('status')->default(1);
            $table->unsignedInteger('tieuchuan_id');
            $table->unsignedInteger('user_id');
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
        Schema::dropIfExists('tieuchis');
    }
}
