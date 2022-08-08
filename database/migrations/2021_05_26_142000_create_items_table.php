<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('items', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('name_ar');
			$table->string('name_en');
			$table->text('description_ar')->nullable();
			$table->text('description_en')->nullable();
			$table->float('price', 10, 0);
			$table->float('calories', 10, 0);
			$table->string('image')->nullable();
			$table->string('branches')->nullable();
			$table->enum('best_seller', ['activate', 'deactivate'])->default('deactivate');
			$table->boolean('view')->default(1);
			$table->bigInteger('category_id')->unsigned()->index();
			$table->softDeletes();
			$table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('RESTRICT')->onDelete('CASCADE');

        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	    //$table->dropForeign('items_category_id_foreign');
		Schema::drop('items');
	}

}
