<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblTOrderCart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_t_order_cart', function (Blueprint $table) {
            $table->id('id_ttoc');
            $table->integer('qty_ttoc');
            $table->integer('total_price_ttoc');
            $table->text('description_ttoc');
            $table->enum('status_ttoc', ['cart', 'purchase'])->default('cart');
            $table->unsignedBigInteger('id_ttps');
            $table->foreign('id_ttps')->references('id_ttps')->on('tbl_t_product_store')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('tbl_t_order_cart');
    }
}
