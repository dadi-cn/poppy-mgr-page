<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterOpQqTokenTableAddOauthField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('op_qq_token', function (Blueprint $table) {
            $table->text('device_info')->comment('设备信息|Demo')->after('access_token');
            $table->text('oauth')->comment('临时授权信息')->after('device_info');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('op_qq_token', function (Blueprint $table) {
            $table->dropColumn(['device_info', 'oauth']);
        });
    }
}
