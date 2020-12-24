<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchievedOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archieved_orders', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('country');
            $table->string('address')->nullable();
            $table->string('postcode')->nullable();
            $table->string('phone');
            $table->string('email');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('owner_id');
            $table->unsignedBigInteger('real_estate_id');
            $table->unsignedBigInteger('original_order');
            $table->float('total');
            $table->integer('months')->nullable();
            $table->enum('method',['COD','GATEWAY'])->default('COD');
            $table->enum('status',['canceled','buying','renting'])->default('canceled');
            $table->text('real_estate_at_this_time')->nullable();
            $table->string('gateway_transaction_checkout_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('real_estate_id')->references('id')->on('real_estates')->onDelete('cascade');
            $table->foreign('original_order')->references('id')->on('orders')->onDelete('cascade');
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
        Schema::dropIfExists('archieved_orders');
    }
}
