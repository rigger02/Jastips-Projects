<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbackTable extends Migration
{
 /**
  * Run the migrations.
  *
  * @return void
  */
 public function up()
 {
  Schema::create('feedback', function (Blueprint $table) {
   $table->id('idfeedback');
   $table->string('feedback')->nullable();
   $table->string('validateEmail');
   $table->foreign('validateEmail')->references('email')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
  Schema::dropIfExists('feedback');
 }
}
