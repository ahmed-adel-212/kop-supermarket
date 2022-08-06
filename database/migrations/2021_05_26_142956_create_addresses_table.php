<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAddressesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('addresses', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('name')->nullable();
			$table->string('street')->nullable();
			$table->string('building_number')->nullable();
			$table->string('floor_number')->nullable();
			$table->string('landmark')->nullable();
			$table->bigInteger('city_id')->unsigned()->index();
			$table->bigInteger('area_id')->index();
			$table->bigInteger('customer_id')->unsigned()->nullable()->index();
			$table->timestamps();
            $table->foreign('area_id')->references('id')->on('areas')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->foreign('city_id')->references('id')->on('cities')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->foreign('customer_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        /*$table->dropForeign('addresses_area_id_foreign');
        $table->dropForeign('addresses_city_id_foreign');
        $table->dropForeign('addresses_customer_id_foreign');*/
		Schema::drop('addresses');
	}

}
