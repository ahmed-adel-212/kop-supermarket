<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOffersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('offers', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('title');
			$table->enum('service_type', array('takeaway','delivery'));
			$table->dateTime('date_from');
			$table->dateTime('date_to');
			$table->text('description')->nullable();
			$table->string('image')->nullable();
			$table->enum('offer_type', array('buy-get','discount'));
			$table->string('title_ar', 191)->nullable();
			$table->string('description_ar', 191)->nullable();
			$table->softDeletes();
			$table->timestamps();
			$table->bigInteger('created_by')->unsigned()->nullable()->index();
			$table->bigInteger('updated_by')->unsigned()->nullable()->index();
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
        $table->dropForeign('offers_created_by_foreign');
        $table->dropForeign('offers_updated_by_foreign');
	    */
		Schema::drop('offers');
	}

}
