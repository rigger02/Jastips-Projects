<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblTCustomerAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_t_customer_address', function (Blueprint $table) {
            $table->id('id_ttca');
            $table->string('name_ttca');
            $table->string('phone_ttca');
            $table->text('static_ttca');
            $table->text('dynamic_ttca')->nullable();
            $table->tinyInteger('isActive_ttca')->default(0);
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
        Schema::dropIfExists('tbl_t_customer_address');
    }
}
