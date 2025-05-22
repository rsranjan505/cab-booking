<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('driver_id');
            $table->string('name');
            $table->string('email',100)->nullable();
            $table->string('mobile',50);
            $table->string('booking_from',100)->nullable();
            $table->string('booking_to',100)->nullable();
            $table->date('booking_date')->nullable();
            $table->time('booking_time')->nullable();
            $table->string('booking_charge',50)->nullable();
            $table->enum('booking_status',['booked','running','completed'])->nullable();
            $table->enum('payment_status',['paid','unpaid'])->default('unpaid')->nullable();

            $table->dateTime('completed_at')->nullable();
            $table->string('vechile_number',30)->nullable();
            $table->tinyInteger('is_cancel')->default(0)->nullable();
            $table->string('cancel_reason')->nullable();
            $table->foreign('driver_id')->references('id')->on('drivers')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
