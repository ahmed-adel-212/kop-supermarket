<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWithoutsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('withouts', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('name_ar');
			$table->string('name_en');
			$table->text('description_ar')->nullable();
			$table->text('description_en')->nullable();
			$table->float('price', 10, 0)->default(0);
			$table->float('calories', 10, 0);
			$table->bigInteger('category_id')->unsigned()->index();
			$table->string('image')->nullable();
			$table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('CASCADE')->onDelete('CASCADE');

        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	    //$table->dropForeign('withouts_category_id_foreign');
		Schema::drop('withouts');
	}

}
