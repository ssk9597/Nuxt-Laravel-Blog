<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('posts', function (Blueprint $table) {
      // id
      $table->bigIncrements('id')->comment("id");
      // title
      $table->string("title", 255)->comment("サイトタイトル");
      // url
      $table->string("url", 255)->comment("サイトURL");
      // content
      $table->text("content")->comment("サイト本文");
      // タイムスタンプ
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
    Schema::dropIfExists('posts');
  }
}
