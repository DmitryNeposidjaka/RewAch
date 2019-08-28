<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAchievementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('achievements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 255)->nullable();
            $table->text('description')->nullable();
            $table->string('thumbnail', 255)->nullable();
            $table->boolean('approved')->default(0);
            $table->bigInteger('parent')->unsigned()->nullable();
            $table->boolean('progressive')->default(0);
            $table->bigInteger('author')->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('parent')
                ->references('id')
                ->on('achievements')
                ->onUpdate('cascade')
                ->onDelete('no action');

            $table->foreign('author')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('achievements');
    }
}
