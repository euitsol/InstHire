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
        Schema::table('job_fair_stall_options', function (Blueprint $table) {
            $table->tinyInteger('status')->default(1)->comment('1 = Active, 0 = Inactive');
        });

        Schema::table('job_fairs', function (Blueprint $table) {
            $table->tinyInteger('status')->default(1)->comment('1 = Scheduled, 2 = Ongoing, 3 = Completed, 0 = Cancelled');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_fair_stall_options', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('job_fairs', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
