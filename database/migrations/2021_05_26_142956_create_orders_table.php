<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('customer_id')->unsigned()->index();
			$table->bigInteger('branch_id')->unsigned()->index();
			$table->enum('service_type', array('takeaway','delivery'));
			$table->float('subtotal', 10, 0);
			$table->float('taxes', 10, 0);
			$table->float('delivery_fees', 10, 0)->nullable();
			$table->float('total', 10, 0);
			$table->enum('state', array('pending','rejected','in-progress','completed','canceled','on-way'));
			$table->text('cancellation_reason', 65535)->nullable();
			$table->softDeletes();
			$table->timestamps();
			$table->bigInteger('created_by')->unsigned()->nullable()->index();
			$table->bigInteger('updated_by')->unsigned()->nullable()->index();
			$table->bigInteger('address_id')->unsigned()->nullable()->index('orders_address_id_foreign');
			$table->integer('points_paid')->default(0);
			$table->string('offer_type', 191)->nullable();
            $table->foreign('address_id')->references('id')->on('addresses')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('branch_id')->references('id')->on('branches')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->foreign('customer_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->foreign('branch_id', 'orders_ibfk_1')->references('id')->on('branches')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->foreign('updated_by')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('CASCADE');

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
        $table->dropForeign('orders_address_id_foreign');
        $table->dropForeign('orders_branch_id_foreign');
        $table->dropForeign('orders_created_by_foreign');
        $table->dropForeign('orders_customer_id_foreign');
        $table->dropForeign('orders_ibfk_1');
        $table->dropForeign('orders_updated_by_foreign');
	    */
		Schema::drop('orders');
	}

}
