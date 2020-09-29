<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
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
            $table->string('email');
            $table->bigInteger('amount');
            $table->string('tracking_code')->index();
            $table->unsignedBigInteger('source_currency_id')->unsigned();
            $table->unsignedBigInteger('destination_currency_id')->unsigned();
            $table->timestamps();

            $table->foreign('source_currency_id')->references('id')->on('currencies')
                ->onDelete('cascade');

            $table->foreign('destination_currency_id')->references('id')->on('currencies')
                ->onDelete('cascade');
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
}
