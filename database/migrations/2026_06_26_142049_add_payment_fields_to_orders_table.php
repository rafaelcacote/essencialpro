<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('payment_id')->nullable()->after('status');
            $table->string('payment_method', 20)->nullable()->after('payment_id');
            $table->string('payment_status', 20)->nullable()->default('pending')->after('payment_method');
            $table->string('easypay_checkout_id')->nullable()->after('payment_status');
            $table->timestamp('paid_at')->nullable()->after('easypay_checkout_id');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'payment_id',
                'payment_method',
                'payment_status',
                'easypay_checkout_id',
                'paid_at',
            ]);
        });
    }
};
