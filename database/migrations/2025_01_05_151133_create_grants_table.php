<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrantsTable extends Migration
{
    public function up()
    {
        Schema::create('grants', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('project_description');
            $table->double('grant_amount');
            $table->string('grant_provider');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('duration');
            $table->foreignId('leader_id')->constrained('academicians')->onDelete('cascade'); // Foreign key for leader
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('grants');
    }
}
