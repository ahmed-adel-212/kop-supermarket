<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCartsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('carts', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('user_id')->unsigned()->index('carts_user_id_foreign');
			$table->bigInteger('item_id')->unsigned()->index('carts_item_id_foreign');
			$table->text('extras', 65535)->nullable();
			$table->text('withouts', 65535)->nullable();
			$table->string('dough_type_ar')->nullable();
			$table->string('dough_type_en')->nullable();
			$table->integer('quantity')->default(1);
			$table->text('offer_id', 65535)->nullable();
			$table->float('offer_price', 10, 0)->nullable();
			$table->timestamps();
            $table->foreign('item_id')->references('id')->on('items')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');

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
        $table->dropForeign('carts_item_id_foreign');
        $table->dropForeign('carts_user_id_foreign');
	    */
		Schema::drop('carts');
	}

}
