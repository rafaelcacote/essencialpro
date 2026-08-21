<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('promo_campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image_path');
            $table->string('button_text')->default('DESBLOQUEIE O SEU DESCONTO');
            $table->string('button_url')->default('/register');
            $table->string('audience', 30)->default('guests'); // guests | all | first_purchase
            $table->foreignId('coupon_id')->nullable()->constrained()->nullOnDelete();
            $table->boolean('is_active')->default(false);
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('promo_campaigns');
    }
};
