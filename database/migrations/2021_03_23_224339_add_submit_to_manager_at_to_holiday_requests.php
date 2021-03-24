<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubmitToManagerAtToHolidayRequests extends Migration
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
            $table->timestamp('submit_to_manager_at')->nullable()->after('submit_to_manager');
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
