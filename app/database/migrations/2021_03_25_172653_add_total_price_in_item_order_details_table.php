<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTotalPriceInItemOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_orders_details', function (Blueprint $table) {
            $table->decimal('final_price', $precision = 8, $scale = 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_orders_details', function (Blueprint $table) {
            $table->dropColumn('final_price');
        });
    }
}
