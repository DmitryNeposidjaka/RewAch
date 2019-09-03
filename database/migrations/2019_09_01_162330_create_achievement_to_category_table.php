<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAchievementToCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('achievement_category', function (Blueprint $table) {
            $table->bigInteger('achievement_id')->unsigned();
            $table->bigInteger('category_id')->unsigned();

            $table->unique(['achievement_id', 'category_id']);

            $table->foreign('achievement_id')
                ->references('id')
                ->on('achievements')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onUpdate('cascade')
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
        Schema::dropIfExists('achievement_to_category');
    }
}
