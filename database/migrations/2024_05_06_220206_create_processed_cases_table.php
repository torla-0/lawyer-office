<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('processed_cases', function (Blueprint $table) {
            $table->id();
            $table->boolean('in_process')->default(false);
            $table->unsignedBigInteger('legal_case_id');
            $table->unsignedBigInteger('lawyer_id');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('legal_case_id')->references('id')->on('legal_cases')->onDelete('cascade');
            $table->foreign('lawyer_id')->references('id')->on('lawyers')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('processed_cases');
    }
};
