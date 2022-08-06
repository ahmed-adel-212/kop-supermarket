<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExtrasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('extras', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('name_ar');
			$table->string('name_en');
			$table->text('description_ar')->nullable();
			$table->text('description_en')->nullable();
			$table->float('price', 10, 0);
			$table->float('calories', 10, 0);
			$table->bigInteger('category_id')->unsigned()->index();
			$table->timestamps();
			$table->string('image')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('RESTRICT')->onDelete('CASCADE');

        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	    //$table->dropForeign('extras_category_id_foreign');
		Schema::drop('extras');
	}

}
