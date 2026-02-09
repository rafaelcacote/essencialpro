<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->enum('client_type', ['company', 'individual']);
            $table->string('company_name')->nullable();
            $table->string('contact_name');
            $table->string('email');
            $table->string('phone');
            $table->string('tax_id'); // NIF / Contribuinte
            $table->string('address');
            $table->string('postal_code');
            $table->string('city');
            $table->string('country');
            $table->text('notes')->nullable(); // Notas Adicionais
            $table->enum('status', ['pending', 'responded', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
