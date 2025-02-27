<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Traits\AuditColumnsTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

return new class extends Migration
{
    use AuditColumnsTrait, SoftDeletes;

    public function up(): void
    {
        Schema::create('job_fair_registrations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('job_fair_id');
            $table->foreign('job_fair_id')->references('id')->on('job_fairs')->onDelete('cascade');

            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');

            $table->tinyInteger('status')->default(0)->comment('0 = Pending, 1 = Accepted, -1 = Declined');

            $this->addMorphedAuditColumns($table);
            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_fair_registrations');
    }
};
