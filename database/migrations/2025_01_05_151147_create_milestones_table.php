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
        Schema::create('milestones', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('milestone_title'); // Foreign key to 'research_grants' table
            $table->date('completion_date'); // Target completion date
            $table->string('deliverable'); // Deliverable description
            $table->string('status'); // Status (e.g., Pending, Completed)
            $table->text('remark'); // Optional remarks
            //$table->date('date_updated'); // Date when the milestone was last updated
            $table->timestamps(); // Created and updated timestamps
            // Foreign key
            $table->foreignId('grant_id')->constrained()->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('milestones');
    }
};
