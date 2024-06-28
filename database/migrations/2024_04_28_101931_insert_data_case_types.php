<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        DB::table('case_types')->insert([
            ['name' => 'Divorce'],
            ['name' => 'Criminal Defense'],
            ['name' => 'Personal Injury'],
            ['name' => 'Business Law'],
            ['name' => 'Real Estate'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('case_types')->whereIn('name', ['Divorce', 'Criminal Defense', 'Personal Injury', 'Business Law', 'Real Estate'])->delete();
    }
};
