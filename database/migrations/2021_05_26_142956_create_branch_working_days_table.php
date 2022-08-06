<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBranchWorkingDaysTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('branch_working_days', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('day');
			$table->string('time_from');
			$table->string('time_to');
			$table->bigInteger('branch_id')->unsigned()->index();
			$table->timestamps();
            $table->foreign('branch_id')->references('id')->on('branches')->onUpdate('RESTRICT')->onDelete('CASCADE');
        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	    //$table->dropForeign('branch_working_days_branch_id_foreign');
		Schema::drop('branch_working_days');
	}

}
