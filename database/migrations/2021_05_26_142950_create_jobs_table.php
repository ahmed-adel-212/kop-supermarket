<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJobsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('jobs', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('title_ar');
			$table->string('title_en');
			$table->text('description_ar')->nullable();
			$table->text('description_en')->nullable();
			$table->boolean('status')->default(1);
			$table->text('brief_description_ar')->nullable();
			$table->text('brief_description_en')->nullable();
			$table->text('responsibilities_ar')->nullable();
			$table->text('responsibilities_en')->nullable();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('jobs');
	}

}
