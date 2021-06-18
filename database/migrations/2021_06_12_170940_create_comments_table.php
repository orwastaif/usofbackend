<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    //id, on_blog, from_user, body, at_time
    Schema::create('comments', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('on_post');
      $table->unsignedBigInteger('from_user');
      $table->text('body');
      $table->timestamps();
    }); 
    Schema::table('comments', function (Blueprint $table) {
        $table->foreign('on_post')->constrained('posts_table')->references('id')->on('posts')->onDelete('cascade');
        $table->foreign('from_user')->constrained('users_table')->references('id')->on('users')->onDelete('cascade');
    }); 
  }
  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    // drop comment
    Schema::drop('comments');
  }
}