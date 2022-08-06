<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderItemTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_item', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('order_id')->unsigned();
			$table->bigInteger('item_id')->unsigned();
			$table->integer('quantity')->default(1);
			$table->string('item_extras')->nullable();
			$table->string('item_withouts')->nullable();
			$table->string('dough_type_ar')->nullable();
			$table->string('dough_type_en')->nullable();
			$table->float('price', 10, 0);
			$table->float('offer_price', 10, 0)->nullable();
			$table->bigInteger('offer_id')->nullable();
			$table->dateTime('offer_last_updated_at')->nullable();
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
		Schema::drop('order_item');
	}

}
