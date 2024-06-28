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
        Schema::table('legal_cases', function (Blueprint $table) {
            $table->unsignedBigInteger('lawyer_id')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
        });
    }

    public function down()
    {
        Schema::table('legal_cases', function (Blueprint $table) {
            $table->dropColumn('lawyer_id');
            $table->dropColumn('start_date');
            $table->dropColumn('end_date');
        });
    }
};
