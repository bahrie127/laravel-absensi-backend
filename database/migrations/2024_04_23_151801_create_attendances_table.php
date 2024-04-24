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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            //user_id (foreign key to users)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            //date
            $table->date('date');
            //time_in
            $table->time('time_in');
            //time_out
            $table->time('time_out')->nullable();
            //latlon_in
            $table->string('latlon_in');
            //latlon_out
            $table->string('latlon_out')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
