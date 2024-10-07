<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();                      
            $table->string('title');           
            $table->text('description');       
            $table->integer('duration');       
            $table->timestamps();              
        });
    }

    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
