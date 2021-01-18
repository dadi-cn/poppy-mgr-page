<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AltArticleContentTableRemoveContentMdField extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('article_content', function(Blueprint $table) {
			$table->dropColumn(['content_md']);
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
			$table->text('content_md')->after('description')->comment('Md 内容');
		});
	}
}
