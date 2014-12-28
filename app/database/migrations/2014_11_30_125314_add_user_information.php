<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserInformation extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->enum('gender', ['m', 'f'])->nullable();
			$table->datetime('dob')->nullable();
			$table->string('telephone')->nullable();
			$table->string('address')->nullable();
			$table->string('city')->nullable();
			$table->integer('postcode')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->dropColumn('gender');
			$table->dropColumn('dob');
			$table->dropColumn('telephone');
			$table->dropColumn('address');
			$table->dropColumn('city');
			$table->dropColumn('postcode');
		});
	}

}
