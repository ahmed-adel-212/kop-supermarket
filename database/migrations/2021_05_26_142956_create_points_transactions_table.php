<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePointsTransactionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('points_transactions', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->integer('points');
			$table->bigInteger('user_id')->unsigned()->index();
			$table->bigInteger('order_id')->unsigned()->nullable()->index();
			$table->integer('status');
			$table->softDeletes();
			$table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('CASCADE');

        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	    //$table->dropForeign('points_transactions_user_id_foreign');
		Schema::drop('points_transactions');
	}

}
