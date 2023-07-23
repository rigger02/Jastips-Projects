<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblMUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_m_user', function (Blueprint $table) {
            $table->id('id_tmu');
            $table->string('name_tmu');
            $table->string('phone_tmu');
            $table->text('password');
            $table->enum('role', ['customer','driver','store','admin'])->default('customer');
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
        Schema::dropIfExists('tbl_m_user');
    }
}
