<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAreasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('areas', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->bigInteger('city_id')->unsigned();
			$table->string('name_ar');
			$table->string('name_en');
			$table->text('description_ar')->nullable();
			$table->text('description_en')->nullable();
			$table->float('delivery_fees', 10, 0)->nullable();
			$table->float('min_delivery_ammount', 10, 0)->nullable();
			$table->softDeletes();
			$table->timestamps();
            $table->foreign('city_id')->references('id')->on('cities')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	    //$table->dropForeign('areas_city_id_foreign');
		Schema::drop('areas');
	}

}
