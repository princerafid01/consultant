<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('geek_id');
            $table->foreignId('user_id');
            $table->foreignId('payment_id');
            $table->string('date');
            $table->string('time');
            $table->string('talk_time');
            // $table->string('talk_time');
            $table->boolean('approved');
            $table->string('timezone');
            $table->string('hourly_rate');
            $table->foreignId('review_id')->nullable();
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
        Schema::dropIfExists('bookings');
    }
}
