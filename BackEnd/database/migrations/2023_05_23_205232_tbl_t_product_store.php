<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblTProductStore extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_t_product_store', function (Blueprint $table) {
            $table->id('id_ttps');
            $table->string('name_ttps');
            $table->string('image_ttps');
            $table->integer('price_ttps');
            $table->enum('status_ttps', ['publish', 'unpublish'])->default('publish');
            $table->unsignedBigInteger('id_tms');
            $table->foreign('id_tms')->references('id_tms')->on('tbl_m_store')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('tbl_t_product_store');
        
    }
}
