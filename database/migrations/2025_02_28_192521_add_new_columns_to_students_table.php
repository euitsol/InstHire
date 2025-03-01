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
        Schema::table('students', function (Blueprint $table) {
            $table->string('latest_degree')->nullable()->after('phone');
            $table->string('latest_institute_name')->nullable()->after('latest_degree');
            $table->string('latest_degree_cgpa')->nullable()->after('latest_institute_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('latest_degree');
            $table->dropColumn('latest_institute_name');
            $table->dropColumn('latest_degree_cgpa');
        });
    }
};
