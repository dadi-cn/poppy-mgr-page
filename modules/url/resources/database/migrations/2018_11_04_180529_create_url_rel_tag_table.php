<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUrlRelTagTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('url_rel_tag', function (Blueprint $table) {
			$table->integer('url_id')->comment('url id');
			$table->integer('tag_id')->default(0)->comment('标签ID');
			$table->integer('account_id')->default(0)->comment('用户ID');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('url_rel_tag');
	}
}
