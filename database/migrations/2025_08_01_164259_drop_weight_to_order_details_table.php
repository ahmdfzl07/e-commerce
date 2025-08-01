<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropWeightToOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->dropColumn('weight');
        });
    }

    public function down()
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->decimal('weight', 10, 2)->nullable()->after('price');
        });
    }
}
