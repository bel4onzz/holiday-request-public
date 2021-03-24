<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubmitToManagerToHolidayRequests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('holiday_requests', function (Blueprint $table) {
            //
            $table->enum('submit_to_manager', ['yes', 'no'])->after('notes')->default('no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('holiday_requests', function (Blueprint $table) {
            //
        });
    }
}
