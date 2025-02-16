<?php

use App\Models\Institute;
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
        Schema::create('institutes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('status')->default(Institute::STATUS_ACTIVE)->comment(Institute::STATUS_ACTIVE.' = active, '.Institute::STATUS_DEACTIVE.' = inactive');
            $table->date('valid_to')->nullable();
            $table->string('image')->nullable();
            $table->string('responsible_person_name');
            $table->string('responsible_person_phone');
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
            $this->addMorphedAuditColumns($table);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('institutes');
    }
};
