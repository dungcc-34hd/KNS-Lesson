<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('tel')->nullable();
            $table->integer('area_id')->nullable();
            $table->integer('province_id')->nullable();
            $table->integer('class_id')->nullable();
            $table->integer('grade_id')->nullable();
            $table->integer('district_id')->nullable();
            $table->integer('quantity_student')->nullable();
            $table->integer('role_id')->nullable();
            $table->string('license_key')->nullable();
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
            $table->dropColumn('tel');
            $table->dropColumn('area_id');
            $table->dropColumn('province_id');
            $table->dropColumn('class_id');
            $table->dropColumn('grade_id');
            $table->dropColumn('district_id');
            $table->dropColumn('quantity_student');
            $table->dropColumn('role_id');
            $table->dropColumn('license_key');
        });
    }
}
