<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parentId');
            $table->integer('postId');
            $table->text('comment');
            $table->text('author');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
