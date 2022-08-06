<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOffersBuyGetTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('offers_buy_get', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('offer_id')->unsigned()->index();
			$table->integer('buy_quantity');
			$table->bigInteger('buy_category_id')->unsigned()->index();
			$table->integer('get_quantity');
			$table->bigInteger('get_category_id')->unsigned()->index();
			$table->integer('offer_price');
			$table->timestamps();
            $table->foreign('buy_category_id')->references('id')->on('categories')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->foreign('get_category_id')->references('id')->on('categories')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->foreign('offer_id')->references('id')->on('offers')->onUpdate('RESTRICT')->onDelete('CASCADE');

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
        $table->dropForeign('offers_buy_get_buy_category_id_foreign');
        $table->dropForeign('offers_buy_get_get_category_id_foreign');
        $table->dropForeign('offers_buy_get_offer_id_foreign');
	    */
		Schema::drop('offers_buy_get');
	}

}
