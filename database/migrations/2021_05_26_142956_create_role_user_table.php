<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRoleUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('role_user', function(Blueprint $table)
		{
			$table->bigInteger('user_id')->unsigned();
			$table->bigInteger('role_id')->unsigned()->index('role_user_role_id_foreign');
			$table->primary(['user_id','role_id']);
            $table->foreign('role_id')->references('id')->on('roles')->onUpdate('CASCADE')->onDelete('CASCADE');
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
        $table->dropForeign('role_user_role_id_foreign');
        $table->dropForeign('role_user_user_id_foreign');
	    */
		Schema::drop('role_user');
	}

}
