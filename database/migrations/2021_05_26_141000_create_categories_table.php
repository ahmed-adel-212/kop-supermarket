<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categories', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('name_ar');
			$table->string('name_en');
			$table->text('description_ar')->nullable();
			$table->text('description_en')->nullable();
			$table->integer('dough_type_id')->nullable()->default(0);
			$table->string('image')->nullable();
			$table->bigInteger('created_by')->unsigned()->nullable()->index();
			$table->bigInteger('updated_by')->unsigned()->nullable()->index();
			$table->softDeletes();
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
        $table->dropForeign('categories_created_by_foreign');
        $table->dropForeign('categories_updated_by_foreign');
        */
		Schema::drop('categories');
	}

}
