<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contacts', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('subject');
			$table->string('body');
			$table->bigInteger('customer_id')->unsigned()->index('contacts_customer_id_foreign');
			$table->softDeletes();
			$table->timestamps();
            $table->foreign('customer_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');

        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	    //$table->dropForeign('contacts_customer_id_foreign');
		Schema::drop('contacts');
	}

}
