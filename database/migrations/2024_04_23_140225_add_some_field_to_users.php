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
        Schema::table('users', function (Blueprint $table) {
            //position
            $table->string('position')->nullable();
            //department
            $table->string('department')->nullable();
            //face_embedding
            $table->text('face_embedding')->nullable();
            //image_url
            $table->string('image_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('position');
            $table->dropColumn('department');
            $table->dropColumn('face_embedding');
            $table->dropColumn('image_url');
        });
    }
};
