<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateThirdPartyUserIdsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('third_party_user_ids', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('user_id')->unsigned()->index('third_party_user_ids_user_id_foreign');
			$table->text('google_user_id', 65535)->nullable();
			$table->text('facebook_user_id', 65535)->nullable();
			$table->timestamps();
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
        //$table->dropForeign('third_party_user_ids_user_id_foreign');
		Schema::drop('third_party_user_ids');
	}

}
