<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSchemaItemOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_orders', function (Blueprint $table) {
            $table->dropColumn(['item_id', 'quantity', 'price']);
            $table->softDeletes();
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
            $table->dropColumn(['item_id', 'quantity', 'price']);
        });
    }
}
