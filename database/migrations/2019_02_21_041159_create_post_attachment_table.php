<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostAttachmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_attachment', function (Blueprint $table) {
            $table->increments('id');
            // $table->integer('post_id'); //unsigned
            // $table->foreign('post_id')->references('id')->on('posts');
            // $table->integer('attachment_id'); //unsigned
            // $table->foreign('attachment_id')->references('id')->on('attachment');
            $table->timestamps();

        });

        Schema::table('post_attachment', function (Blueprint $table) {
            $table->unsignedInteger('post_id');
            $table->unsignedInteger('attachment_id');

            $table->foreign('post_id')
            ->references('id')->on('posts')
            ->onDelete('cascade');

            $table->foreign('attachment_id')
            ->references('id')->on('attachments')
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
        Schema::dropIfExists('post_attachment');
    }
}
