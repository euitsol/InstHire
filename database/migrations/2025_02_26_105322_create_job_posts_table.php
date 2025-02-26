<?php

use App\Models\JobPost;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\AuditColumnsTrait;

return new class extends Migration
{
    use SoftDeletes, AuditColumnsTrait;
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('company_name');
            $table->unsignedBigInteger('category_id');
            $table->tinyInteger('visibility')->comment(JobPost::VISIBLE_PUBLIC.' = public, '.JobPost::VISIBLE_INSTITUTE.' = institute');
            $table->unsignedBigInteger('institute_id')->nullable();
            $table->tinyInteger('type')->comment(JobPost::TYPE_SELF.' = self, '.JobPost::TYPE_EXTERNAL.' = external');
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->string('application_url')->nullable();
            $table->string('email');
            $table->tinyInteger('job_type')->comment(JobPost::FULL_TIME.' = Full-Time, '.JobPost::PART_TIME.' = Part-Time, '.JobPost::WORK_FROM_HOME.' = Work From Home, '.JobPost::CONTRACTUAL.' = Contractual, '.JobPost::INTERN.' = Intern');
            $table->double('salary',10,2)->nullable();
            $table->tinyInteger('salary_type')->comment(JobPost::SALARY_PER_MONTH.' = Per Month, '.JobPost::SALARY_PER_YEAR.' = Per Year, '.JobPost::SALARY_NEGOTIABLE.' = Negotiable');
            $table->datetime('deadline');

            $table->integer('vacancy')->nullable();
            $table->longText('company_address');
            $table->longText('job_responsibility');
            $table->longText('additional_requirement')->nullable();
            $table->longText('job_location');
            $table->longText('other_benefits')->nullable();
            $table->longText('special_instractions')->nullable();
            $table->string('educational_requirement')->nullable();
            $table->string('professional_requirement')->nullable();
            $table->string('experience_requirement')->nullable();
            $table->string('age_requirement')->nullable();
            $table->tinyInteger('status')->default(0);

            $table->timestamps();
            $table->softDeletes();
            $this->addMorphedAuditColumns($table);

            $table->foreign('category_id')->references('id')->on('job_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('institute_id')->references('id')->on('institutes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_posts');
    }
};
