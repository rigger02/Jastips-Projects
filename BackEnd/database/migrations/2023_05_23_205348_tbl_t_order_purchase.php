<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblTOrderPurchase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_t_order_purchase', function (Blueprint $table) {
            $table->id('id_ttop');
            $table->enum('status_ttop', ['process', 'onTheWay', 'delivered'])->default('process');
            $table->string('transaction_ttop');
            $table->unsignedBigInteger('id_ttoc');
            $table->foreign('id_ttoc')->references('id_ttoc')->on('tbl_t_order_cart')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_tmd')->nullable();
            $table->foreign('id_tmd')->references('id_tmd')->on('tbl_m_driver')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_ttca');
            $table->foreign('id_ttca')->references('id_ttca')->on('tbl_t_customer_address')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('tbl_t_order_purchase');
        
    }
}
