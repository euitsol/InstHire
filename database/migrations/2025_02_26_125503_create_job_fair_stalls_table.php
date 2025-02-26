<?php

use App\Traits\AuditColumnsTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    use AuditColumnsTrait, SoftDeletes;
    public function up(): void
    {
        Schema::create('job_fair_stalls', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('job_fair_id');
            $table->foreign('job_fair_id')->references('id')->on('job_fairs')->onDelete('cascade');

            $table->unsignedBigInteger('job_fair_stall_option_id');
            $table->foreign('job_fair_stall_option_id')->references('id')->on('job_fair_stall_options')->onDelete('cascade');

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
        Schema::dropIfExists('job_fair_stalls');
    }
};
