<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('merchant_id');
            $table->foreign('merchant_id')->references('id')->on('merchants');

            $table->unsignedBigInteger('shopper_id');
            $table->foreign('shopper_id')->references('id')->on('shoppers');

            $table->decimal('amount', 10, 2);

            $table->timestamps();

            $table->dateTime('completed_at')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
