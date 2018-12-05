<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_contents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('content')->nullable();
            $table->string('question')->nullable();
            $table->integer('lesson_detail_id')->nullable();
            $table->integer('path')->nullable();
            $table->integer('order_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ls_slide');
    }
}
