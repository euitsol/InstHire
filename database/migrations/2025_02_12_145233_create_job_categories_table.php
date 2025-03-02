<?php

use App\Models\JobCategory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\AuditColumnsTrait;

return new class extends Migration
{
    use SoftDeletes, AuditColumnsTrait;
    public function up(): void
    {
        Schema::create('job_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title', 191)->unique();
            $table->string('slug', 191)->unique();
            $table->tinyInteger('status')->default(JobCategory::STATUS_ACTIVE)->comment(JobCategory::STATUS_ACTIVE.' = active, '.JobCategory::STATUS_DEACTIVE.' = inactive');
            $table->timestamps();
            $table->softDeletes();
            $this->addMorphedAuditColumns($table);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_categories');
    }
};
