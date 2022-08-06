<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJobRequestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('job_requests', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('name');
			$table->string('email');
			$table->string('phone');
			$table->string('cv_file');
			$table->text('description');
			$table->bigInteger('job_id')->unsigned()->nullable()->index('job_requests_job_id_foreign');
			$table->timestamps();
            $table->foreign('job_id')->references('id')->on('jobs')->onUpdate('RESTRICT')->onDelete('CASCADE');

        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	    //$table->dropForeign('job_requests_job_id_foreign');
		Schema::drop('job_requests');
	}

}
