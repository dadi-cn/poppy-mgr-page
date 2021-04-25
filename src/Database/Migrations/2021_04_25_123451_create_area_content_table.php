<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateAreaContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('area_content', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 50)->default('')->comment('地区名称');
            $table->integer('parent_id')->default(0)->comment('父级ID');
            $table->tinyInteger('top_parent_id')->default(0)->comment('顶层ID, 父元素');
            $table->tinyInteger('has_child')->default(0)->comment('是否有子元素');
            $table->tinyInteger('level')->default(0)->comment('级别');
            $table->text('children')->comment('所有的子元素');
            $table->char('code', 12)->default('');
            $table->primary('id');
            $table->index('code', 'k_code');
            
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('area_content');
    }
}
