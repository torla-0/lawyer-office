<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(){
        Schema::table('legal_cases', function (Blueprint $table) {
            $table->foreign('case_type_id')->references('id')->on('case_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(){
        Schema::table('legal_cases', function (Blueprint $table) {
            $table->dropForeign(['case_type_id']);
        });
    }
};
