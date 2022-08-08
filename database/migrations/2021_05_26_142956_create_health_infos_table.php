<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHealthInfosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('health_infos', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('title_ar');
			$table->string('title_en');
			$table->text('description_ar')->nullable();
			$table->text('description_en')->nullable();
			$table->softDeletes();
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
		Schema::drop('health_infos');
	}

}
