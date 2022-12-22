<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('slug');
            $table->unsignedBigInteger('type')->default(0)->comment('0=video , 1=book');
            $table->unsignedBigInteger('resources')->default(1)->comment('resources count');
            $table->unsignedBigInteger('year');
            $table->float('price')->default(0.00);
            $table->string('img',255);
            $table->text('description');
            $table->text('link');
            $table->unsignedBigInteger('submited_by')->nullable();
            $table->unsignedBigInteger('duration')->default(0)->comment('0=1-5 hours','1=5-10 hours','2=10+ hours');
            $table->unsignedBigInteger('difficulty_level')->default(0)->comment('0=Beginer','1=Itermidiate','2=Advanced');
            $table->unsignedBigInteger('platform_id')->nullable();


            $table->foreign('submited_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('platform_id')->references('id')->on('platforms')->onDelete('cascade');
            

            $table->timestamps();
        });

        Schema::create('course_series', function(Blueprint $table){
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('series_id');

            $table->unique(['course_id', 'series_id']);

            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('series_id')->references('id')->on('series')->onDelete('cascade');
        });

        Schema::create('course_topic' , function(Blueprint $table){

            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('topic_id');

            $table->unique(['course_id','topic_id']);

            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('topic_id')->references('id')->on('topics')->onDelete('cascade');
        });

        

        Schema::create('course_author' , function (Blueprint $table){
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('author_id');

            $table->unique(['course_id','author_id']);

            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
};
