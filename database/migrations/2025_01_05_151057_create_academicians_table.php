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
        Schema::create('academicians', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name'); // Name of the academician
            $table->string('staff_number')->unique(); // Unique staff number
            $table->string('email')->unique(); // Email address
            $table->string('college'); // College name
            $table->string('department'); // Department name
            $table->string('position'); // Position (e.g., Professor, Assoc. Prof.)
            $table->timestamps(); // Created and updated timestamps            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academicians');
    }
};
