<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('payments', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('status');
			$table->string('message');
			$table->string('payment_id');
			$table->bigInteger('customer_id')->unsigned()->index();
			$table->bigInteger('order_id')->unsigned()->index();
			$table->bigInteger('total_paid');
			$table->softDeletes();
			$table->timestamps();
            $table->foreign('customer_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->foreign('order_id')->references('id')->on('orders')->onUpdate('RESTRICT')->onDelete('CASCADE');

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
        $table->dropForeign('payments_customer_id_foreign');
        $table->dropForeign('payments_order_id_foreign');
	    */
		Schema::drop('payments');
	}

}
