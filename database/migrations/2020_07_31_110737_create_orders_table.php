<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
          $table->increments('id');
          $table->string('title');
          $table->string('content');
          $table->string('required_skill');
          $table->string('deadline');
          $table->string('status')->nullable();
          $table->integer('eval_point')->nullable(); //evaluation points
          $table->string('assessment')->nullable();  //qualitative
          $table->integer('client_id')->nullable(); //仕事をしてもらった人
          $table->integer('enabler_id')->nullable(); //仕事を手伝った人
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
        Schema::dropIfExists('orders');
    }
}
