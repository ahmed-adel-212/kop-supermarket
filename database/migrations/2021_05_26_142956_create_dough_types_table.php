<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDoughTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dough_types', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->integer('dough_type_id')->unsigned();
			$table->string('name_ar');
			$table->string('name_en');
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
		Schema::drop('dough_types');
	}

}
