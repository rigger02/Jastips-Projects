<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblLFeedback extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_l_feedback', function (Blueprint $table) {
            $table->id('id_tlf');
            $table->text('feedback_tlf');
            $table->unsignedBigInteger('id_tmu');
            $table->foreign('id_tmu')->references('id_tmu')->on('tbl_m_user')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('tbl_l_feedback');
    }
}
