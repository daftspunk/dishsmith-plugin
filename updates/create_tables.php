<?php namespace Responsiv\DishSmith\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateDishSmithTables extends Migration
{

    public function up()
    {
        Schema::create('responsiv_dishsmith_dishes', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('name')->nullable();
            $table->integer('sort_order')->nullable();
            $table->timestamps();
        });

        Schema::create('responsiv_dishsmith_ingredients', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('responsiv_dishsmith_dishes_ingredients', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('dish_id')->unsigned();
            $table->integer('ingredient_id')->unsigned();
            $table->integer('amount')->nullable();
            $table->string('type');
            $table->primary(['dish_id', 'ingredient_id'], 'dish_ingredient_primary');
        });

        Schema::create('responsiv_dishsmith_activities', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('dish_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('responsiv_dishsmith_dishes');
        Schema::drop('responsiv_dishsmith_ingredients');
        Schema::drop('responsiv_dishsmith_activities');
        Schema::drop('responsiv_dishsmith_dishes_ingredients');
    }

}
