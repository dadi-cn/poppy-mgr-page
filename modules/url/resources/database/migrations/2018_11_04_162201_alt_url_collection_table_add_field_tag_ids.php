<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AltUrlCollectionTableAddFieldTagIds extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('url_collection', function (Blueprint $table) {
			$table->text('tag_ids')->after('is_suggest')->comment('标签ID');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('url_collection', function (Blueprint $table) {
			$table->dropColumn(['tag_ids']);
		});
	}
}
