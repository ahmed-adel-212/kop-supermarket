<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCustomersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customers', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('name');
			$table->string('first_name');
			$table->string('middle_name')->nullable();
			$table->string('last_name');
			$table->string('email')->nullable();
			$table->string('password');
			$table->string('remember_token', 100)->nullable();
			$table->string('first_phone');
			$table->string('second_phone')->nullable();
			$table->string('image')->nullable();
			$table->bigInteger('created_by')->unsigned()->nullable()->index();
			$table->bigInteger('updated_by')->unsigned()->nullable()->index();
			$table->timestamps();
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('CASCADE');
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
        $table->dropForeign('customers_created_by_foreign');
        $table->dropForeign('customers_updated_by_foreign');
	    */
		Schema::drop('customers');
	}

}
