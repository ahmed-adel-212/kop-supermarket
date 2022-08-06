<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('name');
			$table->string('first_name');
			$table->string('middle_name')->nullable();
			$table->string('last_name')->nullable();
			$table->string('first_phone')->nullable();
			$table->string('second_phone')->nullable();
			$table->string('image')->nullable();
			$table->string('email')->unique();
			$table->string('age')->nullable();
			$table->dateTime('email_verified_at')->nullable();
			$table->boolean('active')->default(0);
			$table->string('activation_token');
			$table->string('password');
			$table->string('remember_token', 100)->nullable();
			$table->timestamps();
			$table->bigInteger('created_by')->unsigned()->nullable()->index();
			$table->bigInteger('updated_by')->unsigned()->nullable()->index();
			$table->bigInteger('branch_id')->unsigned()->nullable()->index();
			$table->string('device_token')->nullable();
			$table->boolean('first_offer_available')->default(1);
            $table->foreign('branch_id')->references('id')->on('branches')->onUpdate('RESTRICT')->onDelete('RESTRICT');
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
        $table->dropForeign('users_branch_id_foreign');
        $table->dropForeign('users_created_by_foreign');
        $table->dropForeign('users_updated_by_foreign');
	    */
		Schema::drop('users');
	}

}
