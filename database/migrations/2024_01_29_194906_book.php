<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Book extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books',function (Blueprint $table){
            $table->id();
//            $table->integer('category_id');
            $table->integer('price');
            $table->integer('count_of_reads');
            $table->integer('count_of_pages');
            $table->integer('active')->default(1);
            $table->string('title',70);
          $table->string('author',100);
            $table->string('description');
            $table->string('about_author');
            $table->foreignIdFor(\App\Models\Category::class)->constrained();
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
        Schema::dropIfExists('books');
    }
}
