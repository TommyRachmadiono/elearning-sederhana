<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->unsignedInteger('user_id');

            $table->foreign('user_id')
            ->references('id')->on('users')
            ->onDelete('cascade');
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->unsignedInteger('post_id');

            $table->foreign('post_id')
            ->references('id')->on('posts')
            ->onDelete('cascade');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedInteger('course_id');

            $table->foreign('course_id')
            ->references('id')->on('courses')
            ->onDelete('cascade');
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foreign');
    }
}
