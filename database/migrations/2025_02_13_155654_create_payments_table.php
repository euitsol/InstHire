<?php

use App\Models\Payment;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Traits\AuditColumnsTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

return new class extends Migration
{
    use AuditColumnsTrait, SoftDeletes;

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id')->constrained('institutes')->onDelete('cascade');
            $table->foreignId('institute_subscription_id')->constrained('institute_subscriptions')->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->tinyInteger('status')->default(Payment::STATUS_ACTIVE)->comment(Payment::STATUS_ACTIVE.' = accepted, '.Payment::STATUS_DEACTIVE.' = pending');
            $table->softDeletes();
            $table->timestamps();
            $this->addMorphedAuditColumns($table);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
