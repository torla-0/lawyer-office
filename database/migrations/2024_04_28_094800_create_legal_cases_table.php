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

        Schema::create('legal_cases', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('case_type_id');
            $table->text('description');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['open', 'closed', 'pending'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('legal_cases');
    }
};
