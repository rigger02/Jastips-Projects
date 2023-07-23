<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblLLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_l_log', function (Blueprint $table) {
            $table->id('id_tll');
            $table->string('module');
            $table->string('action');
            $table->unsignedBigInteger('useraccess');
            $table->foreign('useraccess')->references('id_tmu')->on('tbl_m_user')->onDelete('cascade')->onUpdate('cascade');
            
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
        Schema::dropIfExists('tbl_l_log');
    }
}
