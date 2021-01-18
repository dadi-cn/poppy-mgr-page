<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AltArticleContentTableAddContentField extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('article_content', function(Blueprint $table) {
			$table->text('content')->after('content_md')->comment('内容');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('article_content', function(Blueprint $table) {
			$table->dropColumn(['content', 'description']);
		});
	}
}
