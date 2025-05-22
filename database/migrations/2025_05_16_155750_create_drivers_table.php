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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email',100)->nullable();
            $table->string('mobile',21)->unique();
            $table->mediumText('address')->nullable();
            $table->string('city',50)->nullable();
            $table->string('state',50)->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->string('zip',11)->nullable();

            $table->tinyInteger('is_own_vechile')->default(0);
            $table->string('vechile_type',21)->nullable();
            $table->string('vechile_number',21)->nullable();
            $table->string('vechile_color',21)->nullable();
            $table->string('vechile_model',21)->nullable();
            $table->string('vechile_capacity',11)->nullable();

            $table->enum('status',['verified','pending'])->default('pending');
            $table->tinyInteger('is_active')->default(0)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
