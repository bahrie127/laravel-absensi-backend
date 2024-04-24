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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            //user_id is a foreign key that references the id column on the users table
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            //date permission is a date column
            $table->date('date_permission');
            //reason
            $table->text('reason');
            //image nullable
            $table->string('image')->nullable();
            // is_approved is a boolean column
            $table->boolean('is_approved')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
