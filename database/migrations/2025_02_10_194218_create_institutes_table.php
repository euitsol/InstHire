<?php

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
            $table->string('email')->unique();
            $table->date('valid_to');
            $table->string('responsible_person_name');
            $table->string('responsible_person_phone');
            $table->string('password');
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
