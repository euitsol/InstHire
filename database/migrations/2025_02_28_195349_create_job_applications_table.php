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
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('job_post_id');
            $table->foreign('job_post_id')->references('id')->on('job_posts')->onDelete('cascade');

            $table->unsignedBigInteger('student_id')->nullable();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');

            $table->unsignedBigInteger('cv_id');
            $table->foreign('cv_id')->references('id')->on('cvs')->onDelete('cascade');

            $table->tinyInteger('status')->default(0)->comment('0 = Applied, 1 = Shortlisted, -1 = Rejected, 2=Called for interview, 3=Interviewed, 4=Accepted');

            // Personal Information
            $table->string('applicant_name')->nullable();
            $table->string('applicant_email')->nullable();
            $table->string('applicant_phone')->nullable();

            // Education Details
            $table->string('degree')->nullable();
            $table->string('institute')->nullable();
            $table->string('result')->nullable();

            // Cover Letter
            $table->text('cover_letter');

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
        Schema::dropIfExists('job_applications');
    }
};
