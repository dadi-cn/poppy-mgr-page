<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpQqTokenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('op_qq_token', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('appid', 20)->comment('Appid , 用来区分王者/和平');
            $table->string('open_id', 50)->comment('OPEN ID');
            $table->string('access_token', 50)->comment('Access Token');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('op_qq_token');
    }
}
