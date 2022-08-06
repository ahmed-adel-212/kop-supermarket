<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGiftsOrderItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('gifts_order_items', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('gifts_order_id')->unsigned()->index();
			$table->bigInteger('gift_id')->unsigned()->index();
			$table->integer('quantity')->default(1);
			$table->timestamps();
            $table->foreign('gift_id')->references('id')->on('gifts')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->foreign('gifts_order_id')->references('id')->on('gifts_orders')->onUpdate('RESTRICT')->onDelete('CASCADE');

        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
/*
        $table->dropForeign('gifts_order_items_gift_id_foreign');
        $table->dropForeign('gifts_order_items_gifts_order_id_foreign');
*/

        Schema::drop('gifts_order_items');
	}

}
