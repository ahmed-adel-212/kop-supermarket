<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOffersDiscountTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('offers_discount', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('offer_id')->unsigned()->index('offers_discount_offer_id_foreign');
			$table->integer('quantity');
			$table->bigInteger('category_id')->unsigned()->index('offers_discount_category_id_foreign');
			$table->integer('discount_type');
			$table->integer('discount_value');
			$table->softDeletes();
			$table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('RESTRICT')->onDelete('CASCADE');
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
        $table->dropForeign('offers_discount_category_id_foreign');
        $table->dropForeign('offers_discount_offer_id_foreign');
	    */
		Schema::drop('offers_discount');
	}

}
