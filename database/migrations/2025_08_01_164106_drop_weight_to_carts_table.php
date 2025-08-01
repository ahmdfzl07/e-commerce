<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropWeightToCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn('cart_weight');
        });
    }

    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->decimal('cart_weight', 10, 2)->nullable()->after('price');
        });
    }
}
