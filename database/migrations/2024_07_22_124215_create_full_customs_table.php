<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFullCustomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('full_customs', function (Blueprint $table) {
            $table->id();
            $table->string('invoice');
            $table->integer('customer_id');
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->text('customer_address');
            $table->string('photo')->nullable();
            $table->string('product_name');
            $table->decimal('photo_width', 12, 2);
            $table->decimal('photo_height', 12, 2);
            $table->string('bukti')->nullable();
            $table->decimal('subtotal', 12, 2);
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('full_customs');
    }
}
