<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_languages', function (Blueprint $table) {
            $table->id();
            $table->integer("id_blog")->nullable();
            $table->integer("id_lang")->nullable();
            $table->char("title")->nullable();
            $table->string("meta_title")->nullable();
            $table->char("short_description")->nullable();
            $table->text("description")->nullable();
            $table->text("image_alt")->nullable();
            $table->text("image_alt_title")->nullable();
            $table->string("slug")->nullable();
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
        Schema::dropIfExists('blog_languages');
    }
}
