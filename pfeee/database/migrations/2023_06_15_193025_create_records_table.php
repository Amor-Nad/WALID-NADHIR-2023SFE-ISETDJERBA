<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordsTable extends Migration
{
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            
            $table->string('full_name');
            $table->string('gender');
            $table->date('date_of_birth');
            $table->string('mobile');
            $table->string('address');
            $table->string('name');
            $table->string('role_name');
            $table->string('email');
            $table->string('password'); // Add the password field
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('records');
    }
}
