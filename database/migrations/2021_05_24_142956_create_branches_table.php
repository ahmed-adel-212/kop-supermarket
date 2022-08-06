<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBranchesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('branches', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('name_ar');
			$table->string('name_en');
			$table->bigInteger('city_id')->unsigned()->index();
			$table->bigInteger('area_id')->index();
			$table->text('address_description');
			$table->text('address_description_en')->nullable();
			$table->string('first_phone');
			$table->string('second_phone')->nullable();
			$table->string('email');
			$table->integer('delivery_fees')->nullable();
			$table->string('service_type');
			/*$table->bigInteger('created_by')->unsigned()->nullable()->index();
			$table->bigInteger('updated_by')->unsigned()->nullable()->index();
			*/
			$table->timestamps();
            $table->foreign('area_id')->references('id')->on('areas')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->foreign('city_id')->references('id')->on('cities')->onUpdate('RESTRICT')->onDelete('CASCADE');
            /*$table->foreign('created_by')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->foreign('updated_by')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('CASCADE');
*/
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
        $table->dropForeign('branches_area_id_foreign');
        $table->dropForeign('branches_city_id_foreign');
        $table->dropForeign('branches_created_by_foreign');
        $table->dropForeign('branches_updated_by_foreign');
        */
		Schema::drop('branches');
	}

}
