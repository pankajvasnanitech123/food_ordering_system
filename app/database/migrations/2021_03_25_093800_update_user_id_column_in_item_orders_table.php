<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUserIdColumnInItemOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_orders', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
        Schema::table('item_orders', function (Blueprint $table) {
            $table->string('user_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_orders', function (Blueprint $table) {
            $table->dropColumn('user_name');
        });
    }
}
