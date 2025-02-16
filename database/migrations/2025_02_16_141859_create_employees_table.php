<?php

use App\Models\Employee;
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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('status')->default(Employee::STATUS_PENDING)->comment(Employee::STATUS_PENDING.' = pending, '.Employee::STATUS_ACCEPTED.' = verified, '.Employee::STATUS_DECLINED.' = declined');
            $table->unsignedBigInteger('verifier_id')->nullable();
            $table->string('verifier_type')->nullable();
            $table->unsignedBigInteger('verified_by_id')->nullable();
            $table->string('verified_by_type')->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->string('image')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            $this->addMorphedAuditColumns($table);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
