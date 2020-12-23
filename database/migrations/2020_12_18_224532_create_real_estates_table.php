<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealEstatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('real_estates', function (Blueprint $table) {
            $table->id();
            // general
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->string('slug')->unique()->nullable();
            $table->text('description');
//            $table->string('video')->nullable();

            //address
            $table->string('address');
            $table->unsignedBigInteger('state_id');
//            $table->string('lat');
//            $table->string('long');

            // public information
            $table->enum('type',['apartment','building','land']);
            $table->enum('category',['buy','rent']);
            $table->enum('status',['available','busy','sold'])->nullable();
//            $table->enum('rent_by',['month'])->nullable();
            $table->integer('floors_number')->nullable();
            $table->integer('flats_number')->nullable();
            $table->float('area');
            $table->float('price');


            // start and end date to be available
            $table->dateTime('start_rent_date')->nullable();
            $table->dateTime('end_rent_date')->nullable();
            $table->dateTime('buy_date')->nullable();

            //services
            $table->boolean('has_pool')->default(false);
            $table->boolean('has_cleaning')->default(false);
            $table->boolean('has_internet')->default(false);
            $table->boolean('has_kitchen')->default(false);
            $table->boolean('has_parking')->default(false);
            $table->boolean('has_garage')->default(false);

            //apartment / flat details
            $table->integer('bed_room_number')->nullable();
            $table->integer('bath_room_number')->nullable();
            $table->integer('living_room_number')->nullable();


            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('real_estates');
    }
}
