<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('eupago_reference')->nullable()->unique()->after('payment_id');
            $table->string('eupago_entity')->nullable()->after('eupago_reference');
            $table->timestamp('payment_expires_at')->nullable()->after('payment_status');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropUnique(['eupago_reference']);
            $table->dropColumn(['eupago_reference', 'eupago_entity', 'payment_expires_at']);
        });
    }
};
