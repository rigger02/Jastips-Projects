<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblMDriver extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_m_driver', function (Blueprint $table) {
            $table->id('id_tmd');
            $table->unsignedBigInteger('id_tmu');
            $table->foreign('id_tmu')->references('id_tmu')->on('tbl_m_user')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('status_tmd', ['aktif', 'nonaktif'])->default('aktif');
            $table->tinyInteger('status_active_account')->default(1);
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
        Schema::dropIfExists('tbl_m_driver');
    }
}
