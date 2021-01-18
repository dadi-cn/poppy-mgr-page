<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEssayContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('essay_content', function (Blueprint $table) {
            $table->increments('id')->comment('文章id');
            $table->string('title', 45)->default('')->comment('标题');
            $table->string('description', 45)->default('描述');
            $table->string('author', 30)->default('')->comment('作者名称');
            $table->text('content')->default('')->comment('内容');
            $table->dateTime('created_at')->nullable()->comment('创建时间');
            $table->dateTime('updated_at')->nullable()->comment('修改时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('essay_content');
    }
}
