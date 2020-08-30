<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
          $table->string('gender');
          $table->string('occupation');
          $table->string('skill');
          $table->integer('slevel'); //skill level
          $table->string('personality');
          $table->integer('point')->nullable();  //accumulated points
          $table->string('evaluation')->nullable(); //qualitative evaluation from others
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
