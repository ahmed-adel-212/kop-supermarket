<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBranchUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('branch_user', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('branch_id')->unsigned()->index();
			$table->bigInteger('user_id')->unsigned()->index();
			$table->timestamps();
            $table->foreign('branch_id')->references('id')->on('branches')->onUpdate('RESTRICT')->onDelete('CASCADE');
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
	    /*
	        $table->dropForeign('branch_user_branch_id_foreign');
			$table->dropForeign('branch_user_user_id_foreign');
	    */
		Schema::drop('branch_user');
	}

}
